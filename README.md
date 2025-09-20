# API FORUM

## Deskripsi Proyek

Proyek ini adalah sebuah API yang dibangun menggunakan framework **Laravel** untuk mengelola data pengguna, postingan, komentar, dan reaksi ["like","dislike"]. API ini mendukung operasi CRUD (Create, Read, Update, Delete) dan dilengkapi dengan sistem autentikasi menggunakan **Laravel Sanctum**.

## Fitur Utama

-   **Autentikasi Pengguna**: Login dan registrasi pengguna menggunakan Sanctum.
-   **Manajemen Post**: Membuat, melihat, memperbarui, dan menghapus postingan.
-   **Manajemen Komentar**: Menambahkan komentar dan balasan ke postingan.
-   **Reaksi (Like)**: Memberikan dan mengelola reaksi pada postingan.
-   **Protected Routes**: Semua *endpoint* sensitif dilindungi oleh *middleware* `auth:sanctum`.

---

## Persyaratan Sistem

-   PHP >= 8.1
-   Composer
-   Laravel >= 10
-   Database (MySQL, PostgreSQL, atau SQLite)

---

## Instalasi

1.  **Clone repositori ini:**
    ```bash
    git clone [https://github.com/Ferdiannnn/APIforum.git](https://github.com/Ferdiannnn/APIforum.git)
    cd nama_repo
    ```

2.  **Instal dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Salin file `.env.example` menjadi `.env`:**
    ```bash
    cp .env.example .env
    ```

4.  **Konfigurasi `.env`:**
    Buka file `.env` dan atur konfigurasi database Anda.

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=user_database_anda
    DB_PASSWORD=password_database_anda
    ```

5.  **Jalankan migrasi database dan seed (opsional):**
    ```bash
    php artisan migrate
    # php artisan db:seed (jika Anda memiliki data seed)
    ```

6.  **Buat Application Key:**
    ```bash
    php artisan key:generate
    ```

7.  **Jalankan server pengembangan Laravel:**
    ```bash
    php artisan serve
    ```
    API akan berjalan di `http://127.0.0.1:8000`.

---

## Dokumentasi API

Semua *endpoint* yang memerlukan autentikasi dilindungi oleh *middleware* `auth:sanctum`. Anda harus menyertakan token autentikasi di header permintaan: `Authorization: Bearer <your-sanctum-token>`.

### **Endpoint Autentikasi dan Pengguna**

| Endpoint | Metode HTTP | Deskripsi |
| :--- | :--- | :--- |
| `/api/login` | `POST` | Autentikasi pengguna dan mengembalikan token. |
| `/api/register` | `POST` | Mendaftarkan pengguna baru. |
| `/api/users` | `GET` | Mengambil daftar semua pengguna. |
| `/api/me` | `GET` | Mengambil data pengguna yang diautentikasi. |

### **Endpoint Post**

| Endpoint | Metode HTTP | Deskripsi |
| :--- | :--- | :--- |
| `/api/posts` | `GET` | Mengambil daftar semua *post*. |
| `/api/posts` | `POST` | Membuat *post* baru. |
| `/api/post/{id}` | `GET` | Mengambil detail *post* tertentu. |
| `/api/post/{id}` | `PUT` | Memperbarui *post* tertentu. |
| `/api/post/{id}` | `DELETE` | Menghapus *post* tertentu. |

### **Endpoint Komentar**

| Endpoint | Metode HTTP | Deskripsi |
| :--- | :--- | :--- |
| `/api/post/{postId}/comments` | `POST` | Menambahkan komentar ke *post*. |
| `/api/post/{postId}/comments/{commentId}` | `PUT` | Memperbarui komentar. |
| `/api/post/{postId}/comments/{commentId}` | `POST` | Menambahkan balasan ke komentar. |
| `/api/post/{postId}/comments/{commentId}` | `DELETE` | Menghapus komentar. |

### **Endpoint Reaksi (Like)**

| Endpoint | Metode HTTP | Deskripsi |
| :--- | :--- | :--- |
| `/api/posts/like` | `GET` | Mengambil semua reaksi pada semua *post*. |
| `/api/posts/{id}/like` | `GET` | Mengambil reaksi pada *post* tertentu. |
| `/api/posts/{id}/like` | `POST` | Menambahkan reaksi pada *post* tertentu. |
| `/api/posts/{id}/like` | `PUT` | Memperbarui atau membatalkan reaksi. |

---
