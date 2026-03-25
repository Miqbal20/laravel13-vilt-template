# Laravel 13 VILT Template

A modern and modular administration dashboard template built with the robust VILT stack. Designed for high performance and rapid application development processing.

## 🚀 Tech Stack

This project utilizes the following core technologies:
- **[Laravel 13](https://laravel.com/)**: The core PHP framework handling the backend logic, authentication, and routing.
- **[Vue.js 3](https://vuejs.org/)**: The reactive frontend framework using the modern Composition API (`<script setup>`).
- **[Inertia.js](https://inertiajs.com/)**: The monolith glue that acts as the router and allows Vue to seamlessly communicate with the server without building an API layer.
- **[Tailwind CSS v4](https://tailwindcss.com/)**: Utility-first CSS framework for rapid and highly customizable UI styling.
- **[SweetAlert2](https://sweetalert2.github.io/)**: Used globally for elegant, beautiful popup notifications, flash messages, and user interaction confirmations.

## 📥 Installation

Follow these steps to set up the project locally after cloning the repository:

1. **Install PHP Dependencies**:
   ```bash
   composer install
   ```
2. **Install Node.js Dependencies**:
   ```bash
   npm install
   ```
3. **Environment Setup**:
   Copy the `.env.example` file to `.env` and configure your credentials:
   ```bash
   cp .env.example .env
   ```
4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```
5. **Run Migrations & Seed the Database**:
   ```bash
   php artisan migrate:fresh --seed
   ```
   **Default Login Credentials:**
   - Email: `test@example.com`
   - Password: `password`

## 🐳 Database setup using Docker (Optional but Recommended)

For an isolated, zero-dependency database layer, a `docker-compose-db.yml` file is provided which spins up a **MySQL 8.0** instance alongside **phpMyAdmin**:

1. Start the Docker containers attached to the project:
   ```bash
   docker compose -f docker-compose-db.yml up -d
   ```
2. Once the container is running, ensure your `.env` connects to `127.0.0.1` on port `3306` with the credentials specified in the compose file (default DB: `laravel`, User: `laravel`, Pass: `secret`).
3. Run migrations to build the necessary tables (including the `Customer` and `Users` table):
   ```bash
   php artisan migrate
   ```
   *(Optionally add `--seed` if you have database seeders prepared)*

## 🏃‍♂️ Running the Application

To run the application locally, you will need two terminal tabs executing simultaneously:

1. **Start the Laravel backend server**:
   ```bash
   php artisan serve
   ```
   *(This generally runs on `http://localhost:8000`)*

2. **Start the Vite frontend development server**:
   ```bash
   npm run dev
   ```

## 🐞 Debugging Setup

This template comes pre-configured with the highly useful **Barryvdh Laravel Debugbar** for development environments.
- It is visible at the bottom of the screen when running locally (`APP_DEBUG=true`).
- It helps you inspect database queries in real-time, view active routes, trace memory usage, dump values, and see Inertia.js shared props easily.

## 🎥 Demo Video

For a visual walkthrough of the template's features, including the authentication system, dashboard widgets, notification dropdowns, and the seamless CRUD module, please play the demo video below:

[▶️ Click Here to Watch the Demo Video](docs/demo.mp4)

> **💡 Github Tip:**  
> GitHub Markdown tidak selalu mendukung rendering `<video>` tag untuk file *relative local*. Agar video bisa menampilkan *player* otomatis di halaman repositori Anda, *edit* README ini melalui web GitHub, hapus baris di atas, lalu *Drag & Drop* file `docs/demo.mp4` langsung ke dalam editor. GitHub akan meng-generate URL khusus yang otomatis menjadi video player.
