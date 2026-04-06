<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Service responsible for generating blog content using the OpenAI API.
 * It accepts a topic and returns structured content including a title,
 * short description, full HTML content, meta title, meta description and
 * comma‑separated keywords.  This class isolates all API interaction and
 * parsing logic from controllers.
 */
class BlogGeneratorService
{
    /**
     * Generate a blog post on the given topic using OpenAI.
     *
     * @param string $topic
     * @return array
     */
    public function generateBlog(string $topic): array
    {
        $apiKey = config('services.openai.key');
        if (empty($apiKey)) {
            throw new \RuntimeException('OpenAI API key is not configured. Please set OPENAI_API_KEY in your .env.');
        }
        // Compose the prompt instructing the AI to return JSON.
        $prompt = "You are a copywriter for a digital agency. Write a professional blog post about: {$topic}. " .
                  "Return a JSON object with keys 'title', 'short_description', 'content', 'meta_title', 'meta_description', 'meta_keywords'. " .
                  "The 'short_description' should be a concise summary (1–2 sentences). The 'content' should be 3–5 paragraphs of HTML. " .
                  "'meta_title' must be under 70 characters; 'meta_description' under 160 characters; 'meta_keywords' should be a comma‑separated list of up to 5 SEO keywords.";
        // Call the OpenAI Chat API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful content generation assistant.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
            'max_tokens' => 800,
        ]);
        if (!$response->successful()) {
            throw new \RuntimeException('Failed to contact AI service: ' . $response->body());
        }
        $body = $response->json();
        $text = $body['choices'][0]['message']['content'] ?? '';
        // Attempt to parse the JSON returned by the AI
        $json = json_decode($text, true);
        if (!is_array($json)) {
            throw new \RuntimeException('AI returned invalid JSON: ' . $text);
        }
        return $json;
    }
}