# Translation Management Service

A high-performance, API-driven translation management service built with Laravel 12.  
Designed to handle multilingual translations (e.g., `en`, `fr`, `es`, `zh`) with tagging for contextual use (e.g., `mobile`, `web`, `desktop`) and optimized for large-scale data operations.

## Features

-  Manage translations across multiple locales.
-  Contextual tagging (e.g., `mobile`, `web`, etc.)
-  Filter/search by key, tag, translation.
-  User authentication with API tokens.
-  Efficient data seeding for performance testing (100,000+ translations).
-  Token-based authentication (no session required).
-  JSON responses standardized via custom API response trait.

---

##  Folder Structure Overview

app/  
├── Http/  
│ ├── Controllers/  
│ │ └── Api/  
│ │ ├── AuthController.php  
│ │ └── TranslationController.php  
│ ├── Requests/  
│ │ ├── LoginRequest.php  
│ │ ├── RegisterRequest.php  
│ │ └── TranslationRequest.php  
│ └── Traits/  
│ └── ApiResponseTrait.php  
├── Models/  
│ └── Translation.php  
database/  
├── factories/  
│ └── TranslationFactory.php  
├── seeders/  
│ └── TranslationSeeder.php  
routes/  
├── api.php  


## API Endpoints

| Method | Endpoint                            | Description                        | Auth Required |
|--------|-------------------------------------|------------------------------------|---------------|
| POST   | `/api/register`                     | User registration                  | ❌            |
| POST   | `/api/login`                        | User login (returns token)         | ❌            |
| POST   | `/api/logout`                       | Logout current user                | ✅            |
| GET    | `/api/translations`                 | List/filter translations           | ✅            |
| GET    | `/api/translations/export/{local?}` | Export all translations (JSON)     | ✅            |
| POST   | `/api/translation/store`            | Create a new translation           | ✅            |
| POST   | `/api/translations/update/{id}`     | Update a translation               | ✅            |
| DELETE | `/api/translations/{id}`            | Delete a translation               | ✅            |

## Installation  
git clone https://github.com/AsadLatifArain/translation-management-service.git  
cd translation-management-service  

composer install  
cp .env.example .env  
php artisan key:generate  

php artisan migrate --seed  
php artisan serve  
