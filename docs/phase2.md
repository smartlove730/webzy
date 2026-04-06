# Phase 2 – Migrations, Models and Seeders

In Phase 2 the data layer for **Webzy** has been implemented. This phase establishes the database schema via migrations, defines the Eloquent models and their relationships, and populates the database with realistic seed data. The focus is to provide a clean and scalable foundation that supports all of the dynamic features required by the project.

## Migrations

The following migration files have been added to the `database/migrations` directory. Each migration uses Laravel’s schema builder to define tables, columns, indexes and foreign‑key relationships. Order of creation ensures that referenced tables exist before they are used:

| Migration file | Purpose |
|---|---|
| **2024_01_01_000000_create_users_table.php** | Creates the `users` table with fields for name, email, password, role and timestamps. |
| **2024_01_01_000001_create_pages_table.php** | Stores custom pages such as Home, About, Services, Portfolio, Blog and Contact. Includes fields for content and SEO metadata. |
| **2024_01_01_000002_create_sections_table.php** | Defines page sections. Each section belongs to a page and includes an identifier, title, content and order field for layout positioning. |
| **2024_01_01_000003_create_services_table.php** | Holds individual service records with slug, icon, image, descriptions and metadata. |
| **2024_01_01_000004_create_portfolio_table.php** | Stores portfolio projects with client name, category, date, location, images and SEO metadata. |
| **2024_01_01_000005_create_blog_categories_table.php** | Blog categories table. |
| **2024_01_01_000006_create_blog_tags_table.php** | Blog tags table. |
| **2024_01_01_000007_create_blog_posts_table.php** | Stores blog posts with references to categories and authors. Includes content, featured image, SEO fields and publication data. |
| **2024_01_01_000008_create_blog_post_tag_table.php** | Pivot table linking blog posts to tags (many‑to‑many). |
| **2024_01_01_000009_create_menus_table.php** | Defines a menu (e.g. main navigation) with name and location. |
| **2024_01_01_000010_create_menu_items_table.php** | Holds menu items. Supports parent/child hierarchy to allow dropdowns and ordering. |
| **2024_01_01_000011_create_footer_sections_table.php** | Defines footer sections that group links and content. |
| **2024_01_01_000012_create_footer_links_table.php** | Stores links belonging to a footer section. |
| **2024_01_01_000013_create_settings_table.php** | Key/value settings table used for general site configuration. |
| **2024_01_01_000014_create_theme_settings_table.php** | Stores theme colours and branding assets (logo and favicon). |
| **2024_01_01_000015_create_seo_data_table.php** | A polymorphic table for storing SEO metadata for any model (via `model_type`/`model_id`). |
| **2024_01_01_000016_create_social_links_table.php** | Holds social media links. |
| **2024_01_01_000017_create_newsletter_subscribers_table.php** | Records newsletter subscribers. |
| **2024_01_01_000018_create_contact_messages_table.php** | Stores contact form submissions with read/unread status. |
| **2024_01_01_000019_create_firebase_settings_table.php** | Stores Firebase server key, sender ID and project ID to facilitate push notifications. |
| **2024_01_01_000020_create_media_table.php** | Records uploaded media with reference to the user. |

These migrations define a robust, normalized schema to support all content types, dynamic menus, settings and integrations requested in the project brief. Foreign keys include cascade or null‑on‑delete rules to maintain referential integrity. The design follows the MVC architecture and request lifecycle described in Laravel’s documentation, which emphasises clear separation of concerns between models, views and controllers【299524939897941†L165-L178】.

## Models and Relationships

Under `app/Models` you will find a model class for each table. They extend Laravel’s base model and include `fillable` definitions for mass assignment. Relationships are defined using Eloquent’s methods (e.g. `belongsTo`, `hasMany`, `belongsToMany`):

- **User** extends `Authenticatable` and defines relations to blog posts and media uploads.
- **Page** has many **Section** objects.
- **Section** belongs to a **Page**.
- **Service**, **Portfolio**, **ThemeSetting**, **Setting**, **SocialLink**, **NewsletterSubscriber**, **ContactMessage**, **FirebaseSetting**, **Media** and **SeoData** are simple models with minimal relations.
- **BlogCategory** has many **BlogPost** entries.
- **BlogTag** belongs to many **BlogPost** instances via the `blog_post_tag` pivot table.
- **BlogPost** belongs to a **BlogCategory**, belongs to an **author (User)** and has many **BlogTag** objects through the pivot table. It also casts `is_published` to boolean and `published_at` to a `datetime` object.
- **Menu** has many **MenuItem** records.
- **MenuItem** belongs to a **Menu**, may have a parent item (for nested menus) and a `children()` relation for its sub‑items.
- **FooterSection** has many **FooterLink** entries.
- **FooterLink** belongs to a **FooterSection**.
- **SeoData** defines a polymorphic relation allowing any model to have associated SEO metadata.

These definitions ensure that data can be retrieved in a structured, expressive manner throughout the controllers and views.

## Seeders

The database seeders populate tables with realistic, production‑ready content. Running `php artisan db:seed` after migrations will insert the following:

| Seeder | Purpose |
|---|---|
| **AdminUserSeeder** | Creates a default admin user (`admin@webzy.co.in`) with a hashed password and role `admin`. |
| **SettingSeeder** | Stores general site configuration (site title, tagline, contact email/phone and address). |
| **ThemeSettingSeeder** | Inserts primary and secondary colours along with logo and favicon paths to support dynamic theming. |
| **PageSeeder** | Inserts core pages (Home, About Us, Services, Portfolio, Blog and Contact Us) with full bodies of copy and SEO metadata. |
| **SectionSeeder** | Creates structured sections for the home page (hero, about, services, portfolio, testimonials, call‑to‑action and blog). Each section contains polished copy and optional HTML markup for CTAs. |
| **ServiceSeeder** | Adds six well‑defined services: Custom Website Development, E‑commerce Solutions, Mobile App Development, UI/UX Design, Content Management Systems, and SEO & Digital Marketing. Each entry includes a slug, icon, image file, detailed descriptions and SEO metadata. |
| **PortfolioSeeder** | Adds four detailed portfolio case studies for clients such as ABC Industries, FashionHub, Foodies and StartupX, complete with descriptions, dates, locations and metadata. |
| **BlogCategorySeeder** | Creates blog categories such as Web Development, Design, Marketing and Announcements. |
| **BlogTagSeeder** | Adds commonly used tags such as Laravel, PHP, Vue, React, Design, SEO and UX. |
| **BlogPostSeeder** | Generates three fully written blog posts on topics including bespoke vs. template websites, web development trends for 2026 and UI/UX best practices. Each post is associated with categories and tags, assigned to the admin author and published with timestamps. |
| **MenuSeeder** | Creates a “Main Navigation” menu with ordered items (Home, About, Services, Portfolio, Blog, Contact). |
| **FooterSeeder** | Builds four footer sections (“Company”, “Services”, “Resources”, “Contact”) with descriptive text and useful links. |
| **SocialLinkSeeder** | Seeds links for LinkedIn, Twitter/X, Facebook, Instagram and YouTube using FontAwesome icon identifiers. |
| **NewsletterSubscriberSeeder** | Adds two example newsletter subscribers. |
| **ContactMessageSeeder** | Adds sample contact form submissions to demonstrate the functionality. |
| **FirebaseSettingSeeder** | Inserts an empty record for Firebase configuration to be updated via the admin panel. |
| **MediaSeeder** | Seeds entries for each image used throughout the site (logo, services, portfolio and blog posts) so they can be managed via the media library. |
| **SeoDataSeeder** | Demonstrates use of the polymorphic `seo_data` table by attaching SEO metadata to the home page. |

These seeders provide realistic content and metadata, meaning that once the migrations are run and seeders executed, the site will display professional copy, images and structured navigation without any dummy placeholder text. The admin user can log in immediately and start managing content.

## Usage and next steps

1. **Run migrations and seeders:** After cloning the repository and installing dependencies, execute `php artisan migrate --seed` to create all tables and insert the seed data. (In this environment we cannot run PHP, but the migrations and seeders are ready for execution on your local machine.)
2. **Review and update content:** Feel free to customize the seeded content via the admin panel once implemented. The provided copy serves as a solid foundation for a professional web development services site.
3. **Proceed to Phase 3:** With the data layer in place, the next phase will focus on building the full admin panel (CMS) including authentication, CRUD interfaces and dynamic management for all content types (pages, services, portfolio, blog, menus, footer, settings, media, notifications, SEO and more).

The migrations, models and seeders created in this phase lay a scalable foundation for the rest of the application. They support clean architecture and follow Laravel best practices for naming, relationships and seeding.