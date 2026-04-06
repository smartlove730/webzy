# Phase 3 – Admin Panel Implementation

Phase 3 of the **Webzy** project focuses on building a comprehensive content‑management interface for administrators.  This phase transforms the static data structures defined in Phase 2 into a fully dynamic and user‑friendly admin panel where content, settings and media can be managed without touching the codebase.

## Overview of Completed Features

### 1. Administrative Layout

* A responsive Tailwind‑based layout (`resources/views/admin/layouts/app.blade.php`) anchors all admin pages.  It uses a fixed sidebar and a header with user information.  Flash messages and error handling are centralized here so every page automatically displays success/error notices.
* The sidebar menu now includes links for all CMS modules: Pages, Services, Portfolio, Blog (Posts, Categories, Tags), Menus and Menu Items, Footer (Sections & Links), Settings (General, Theme, SEO, Social Links, Firebase), Media Library, Newsletter Subscribers and Contact Messages.

### 2. Social Links Module

The social links module allows administrators to maintain the list of social media profiles displayed in the site footer and header:

* **Model:** `SocialLink` with attributes `platform`, `url` and `icon` (FontAwesome class).
* **CRUD controller:** `Admin\SocialLinkController` now performs full CRUD.  The `index()` method lists social links ordered by platform.  `store()` and `update()` validate input and persist records.  Deleting a link removes it from the database.
* **Views:** Three new Blade views (`index`, `create` and `edit`) display a paginated table of links and simple forms for adding or editing social links.  Icons are rendered using FontAwesome.

### 3. Footer Management

The footer area of the website is divided into **sections** (e.g., “Company”, “Services”, “Resources”, “Contact”) and **links** within those sections.  Managing these pieces dynamically required implementing two linked modules:

* **Footer sections:** Administrators can list, create, edit and delete sections.  Each section has a `title`, optional `content` (rich text) and an `order` field for sorting.  The section edit page also lists its related links and provides an *Add Link* button.
* **Footer links:** A link belongs to a section and has a `title`, `url` and `order`.  The controller now provides an index view showing all links with their parent section and CRUD operations.  When creating or editing a link, administrators select the section from a dropdown.

### 4. Newsletter Subscribers

The newsletter subscription system captures emails via the public site.  In the admin panel, the **Subscribers** page displays a paginated list of subscriber emails and their subscription dates.  Admins can remove subscribers from the list via a simple delete action.

### 5. Contact Messages

Contact form submissions are stored in the `contact_messages` table.  The admin interface provides:

* A list view showing sender name, email, subject, read status and received date.
* A detail view where administrators can read the full message.  Opening the message marks it as read.  Messages can be deleted.

### 6. Media Library

To support media uploads used across pages and posts, a basic media library is implemented:

* The library lists uploaded files with name, MIME type, size and upload date.  Files can be deleted.
* An upload form accepts images and common document types.  Uploaded files are stored in `storage/app/public/media` and recorded in the `media` table with metadata (user_id, original file name, path, type and size).

### 7. Settings Management

The admin panel exposes configurable settings grouped into separate pages:

1. **General settings:** Manage `site_title`, `site_tagline`, `contact_email`, `contact_phone` and `address` along with global SEO defaults (`default_meta_title`, `default_meta_description`, `default_meta_keywords`, `default_canonical_url`).  Values are persisted to the `settings` table via a key–value mechanism.
2. **Theme settings:** Configure colours (`primary_color`, `secondary_color`) and upload logo and favicon images.  Files are stored in the `public` disk; their paths are stored in the `theme_settings` table.
3. **SEO settings:** A dedicated page allows editing of the default SEO fields independently of the general settings page.
4. **Firebase settings:** Configure push notification credentials (`server_key`, `sender_id`, `project_id`) stored in the `firebase_settings` table.

### 8. Subscribers, Messages and Media Controllers

The controllers handling subscribers, contact messages and media library now perform actual database queries instead of returning placeholder views.  Subscribers are paginated and can be removed.  Contact messages are retrieved and marked as read when viewed.  The media controller handles file uploads, storing metadata and physical files via Laravel’s `Storage` facade and deleting both upon request.

## How This Fits Into the MVC Architecture

Laravel’s MVC structure promotes separation of concerns where controllers orchestrate business logic, models interact with the database and views render the UI.  When a request reaches the application, Laravel resolves the appropriate controller through routing, invokes the method, interacts with models and returns a view or redirects.  Middleware runs before and after the request to handle tasks such as authentication and CSRF protection.  The documentation consulted in Phase 1 explains this lifecycle and directory roles in detail【299524939897941†L165-L178】【299524939897941†L390-L437】.

All CRUD operations implemented in this phase follow Laravel best practices: validating requests with `$request->validate()`, using fillable models for mass assignment, eager loading relationships (`with('links')` for footer sections) and paginating results for better performance.  Blade templates extend a common layout to ensure a cohesive user experience.

## Next Steps

Phase 4 will focus on building the public‑facing frontend using Blade templates.  The dynamic content created and managed through the admin panel will be rendered on pages like Home, About, Services, Portfolio, Blog and Contact.  Additionally, global SEO metadata and theme settings configured here will be applied to the frontend.