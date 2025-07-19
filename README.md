# Learnify - Learning Management System

## Overview
Learnify is a modern web-based learning management system built with Laravel. This platform provides a comprehensive solution for educational institutions, trainers, and learners to manage courses, track progress, and facilitate online learning experiences.

## Features
- **Course Management**: Create, organize, and manage educational content
- **User Management**: Support for different user roles (students, instructors, administrators)
- **Interactive Learning**: Engaging learning modules and assessments
- **Progress Tracking**: Monitor student progress and performance
- **Responsive Design**: Optimized for desktop and mobile devices

## Technology Stack
- **Backend**: PHP with Laravel Framework
- **Frontend**: Blade templating engine with CSS
- **Database**: MySQL (configurable)
- **Server Requirements**: PHP 8.0+, Composer

## Installation

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL or another supported database
- Web server (Apache/Nginx)

### Setup Instructions

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Mohamed-Rag/learnify.git
   cd learnify
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Environment configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**:
   Edit the `.env` file with your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=learnify
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run database migrations**:
   ```bash
   php artisan migrate
   ```

6. **Seed the database** (optional):
   ```bash
   php artisan db:seed
   ```

7. **Start the development server**:
   ```bash
   php artisan serve
   ```

The application will be available at `http://localhost:8000`

## Project Structure
```
learnify/
├── app/                    # Application logic
├── bootstrap/              # Bootstrap files
├── config/                 # Configuration files
├── database/               # Database migrations and seeders
├── public/                 # Public assets
├── resources/              # Views, CSS, JS
├── routes/                 # Route definitions
├── storage/                # File storage
├── tests/                  # Test files
├── .env.example            # Environment variables template
├── artisan                 # Laravel command-line interface
├── composer.json           # PHP dependencies
└── README.md              # This file
```

## Usage
After installation, you can:
- Access the admin panel to manage courses and users
- Create student accounts for learners
- Upload course materials and create assessments
- Monitor student progress through the dashboard

## Development
To contribute to this project:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Testing
Run the test suite:
```bash
php artisan test
```

## Deployment
For production deployment:
1. Set `APP_ENV=production` in your `.env` file
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Set up proper web server configuration

## Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

## License
This project is open-sourced software licensed under the MIT license.

## Support
For support and questions, please contact Mohamed-Rag or open an issue on GitHub.

