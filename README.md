# Airbnb Clone

This is a site where users can browse, book, and manage apartments.

In the user profile, we can see details about the user and the apartments reserved by them.

The admin can manage all apartments and users. They can change user roles and update user information.


## Features

* **User Authentication:**  
  Users can register and log in to their accounts.

* **Apartment Listings:**  
  Explore a wide range of apartment listings from various hosts.

* **Booking System:**  
  Book your desired apartment and view your upcoming and past bookings.

* **Top Destinations:**  
  Discover the most popular places to stay, based on user interest.

## User Dashboard

### After logging in, users can:

* View and manage their bookings.
* See their own listings and propositions.
* Explore popular travel destinations and descriptions.

## How to Start

### Preparation:
You need the following tools installed on your system:

* PHP  
  Verify installation:
  ```bash
  php -v
  ```

* Composer   
  Verify installation:
  ```bash
  composer -V
  ```

* Docker   
  Verify installation:
  ```bash
  docker -V
  ```

#### If any tools are missing:
* [PHP](https://www.php.net/downloads)
* [Composer](https://getcomposer.org/download/)
* [Docker](https://www.docker.com/products/docker-desktop)

### Installation Steps:

1. **Install Laravel Installer (if not already installed):**
   ```bash
   composer global require laravel/installer
   ```

2. **Restart your terminal and verify the Laravel installation:**
   ```bash
   laravel --help
   ```

   If there are any errors, refer to the official Laravel documentation:  
   [Laravel Installation Guide](https://laravel.com/docs/12.x/installation)

3. **Clone the Repository:**
   ```bash
   git clone https://github.com/murzikkot978/laravel-airbnb.git
   ```

4. **Navigate into the project directory:**
   ```bash
   cd laravel-airbnb
   ```

5. **Install Laravel Sail:**
   ```bash
   php artisan sail:install
   ```

6. **Start the Laravel application using Sail:**
   ```bash
   ./vendor/bin/sail up
   ```

7. **Install JavaScript dependencies:**
   ```bash
   npm install
   npm run dev
   ```

8. **Run database migrations:**
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

9. **Access the application in your browser:**  
   Your server will be available at:  
   [http://localhost](http://localhost)

---

### Notes:
* Ensure your Docker service is up and running before starting Laravel Sail.
* The `npm run dev` command compiles front-end assets using tools like Vite/Tailwind CSS (required for full functionality).
* Check if your `.env` file is properly configured for database and other environment-specific settings.
