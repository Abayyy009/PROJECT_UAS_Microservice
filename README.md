# Microservices Web Project

## Overview
This project demonstrates the implementation of microservices architecture in a web-based system that was initially built as a monolithic application. The project focuses on transitioning specific features to microservices for better scalability and maintainability.

### Features Implemented with Microservices:
1. **Checkout**: Allows users to place orders by filling in recipient information, selecting a courier, and calculating shipping costs using the RajaOngkir API.
2. **Payment**: Enables users to manually upload proof of payment for order confirmation.

Other features such as login and registration remain in the monolithic architecture.

---

## Project Setup

### Prerequisites
- PHP installed on the server.
- MySQL/MariaDB for the database.
- Composer for dependency management.
- Git for version control.

### Installation Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/username/repository-name.git
   ```
2. Navigate to the project directory:
   ```bash
   cd repository-name
   ```
3. Install dependencies (if applicable):
   ```bash
   composer install
   ```
4. Import the database:
   - Locate the database SQL file (e.g., `database.sql`).
   - Import it into your database server using a tool like phpMyAdmin or the MySQL CLI:
     ```bash
     mysql -u username -p database_name < database.sql
     ```
5. Configure the database connection in `koneksi.php`:
   ```php
   $conn = new PDO('mysql:host=your_host;dbname=your_database', 'username', 'password');
   ```

6. Ensure writable permissions for the `gambar/bukti_pembayaran` folder to upload payment proofs.

---

## Features

### 1. Checkout Service
- **Endpoint**: `/checkout_service.php`
- **Method**: POST
- **Description**: Handles the checkout process, including recipient information, courier selection, and order placement.
- **External API**: RajaOngkir API for calculating shipping costs.
- **Payload Example**:
  ```json
  {
      "nama": "John Doe",
      "hp": "08123456789",
      "alamat": "Jl. Mawar No. 1, Jakarta",
      "provinsi": "DKI Jakarta",
      "kabupaten": "Jakarta Selatan",
      "kurir": "JNE",
      "berat": 1000,
      "ongkir": 20000,
      "total_bayar": 120000
  }
  ```

### 2. Payment Service
- **Endpoint**: `/payment_service.php`
- **Method**: POST
- **Description**: Processes payment proof uploads for order confirmation.
- **Payload Example (Form-Data)**:
  - `id`: Invoice ID.
  - `bukti`: File (image) for payment proof.

---

## Testing

### Using Postman
1. Open Postman and import the API collection.
2. For the **Checkout** feature:
   - Set the endpoint to `/checkout_service.php`.
   - Use the POST method and input the required JSON payload.
3. For the **Payment** feature:
   - Set the endpoint to `/payment_service.php`.
   - Use the POST method with form-data, including the `id` and `bukti` fields.

---

## Limitations
- The payment process currently does not use a payment gateway like Midtrans and relies on manual proof uploads.
- The system requires further optimization for production use.

---

## Future Improvements
- Integrate automated payment gateways (e.g., Midtrans, Stripe).
- Implement better error handling and logging for microservices.
- Add unit tests and API tests for better reliability.
- Containerize services using Docker for easier deployment.

---

## License
This project is licensed under the [MIT License](LICENSE).

---

## Acknowledgments
- [RajaOngkir API](https://rajaongkir.com/) for shipping cost calculation.
- Open-source libraries and tools used in this project.

