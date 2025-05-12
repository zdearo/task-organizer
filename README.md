[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F7786928c-2a7e-42e9-bb20-7181aeda45fb%3Fdate%3D1%26label%3D1&style=flat)](https://forge.laravel.com/servers/917838/sites/2713526)

# Task Organizer

A task management application built with Laravel and Filament.

## Features
- Task creation, editing, and deletion
- User authentication and authorization
- Task prioritization and categorization
- Modern UI with Filament

## Installation

### Prerequisites
Ensure you have the following installed:
- PHP 8.3+
- Composer
- Node.js & npm
- SqLite, MySQL or PostgreSQL database

### Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/zdearo/task-organizer.git
   cd task-organizer
   ```

2. Install dependencies:
   ```sh
   composer install
   npm install && npm run build
   ```

3. Set up environment variables:
   ```sh
   cp .env.example .env
   ```
   Configure database credentials in the `.env` file.

4. Generate application key:
   ```sh
   php artisan key:generate
   ```

5. Run migrations and seed the database:
   ```sh
   php artisan migrate
   ```

6. Serve the application:
   ```sh
   composer run dev
   ```

7. Access the application at `http://localhost:8000`

## Contribution

### How to Contribute
1. Fork the repository.
2. Create a new branch:
   ```sh
   git checkout -b feature-branch
   ```
3. Make your changes and commit:
   ```sh
   git commit -m "Added new feature"
   ```
4. Push to your forked repository:
   ```sh
   git push origin feature-branch
   ```
5. Open a Pull Request.

## License
This project is licensed under the MIT License.
