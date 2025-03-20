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
