# API Booking - Dokumentasi Lengkap

## Base URL
```
http://localhost:8000/api
```

---

## 1. GET - Semua Bookings
**Endpoint:** `GET /api/bookings`

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "booking_code": "BKXYZ123AB",
      "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
      },
      "court": {
        "id": 1,
        "name": "COURT_A",
        "status": "tersedia",
        "harga": 100000
      },
      "date": "2026-04-30",
      "start_time": "09:00",
      "end_time": "11:00",
      "duration_hours": 2,
      "total_price": 200000,
      "status": "pending",
      "created_at": "2026-04-29T10:30:00.000000Z"
    }
  ]
}
```

---

## 2. GET - Detail Booking
**Endpoint:** `GET /api/bookings/{id}`

**Example:**
```
GET /api/bookings/1
```

**Response:**
```json
{
  "id": 1,
  "booking_code": "BKXYZ123AB",
  "user": {...},
  "court": {...},
  "date": "2026-04-30",
  "start_time": "09:00",
  "end_time": "11:00",
  "duration_hours": 2,
  "total_price": 200000,
  "status": "pending",
  "created_at": "2026-04-29T10:30:00.000000Z"
}
```

---

## 3. POST - Create Booking
**Endpoint:** `POST /api/bookings`

**Headers:**
```
Content-Type: application/json
```

**Request Body:**
```json
{
  "user_id": 1,
  "court_id": 1,
  "date": "2026-04-30",
  "start_time": "09:00",
  "end_time": "11:00",
  "duration_hours": 2,
  "total_price": 200000
}
```

**Response (201 Created):**
```json
{
  "id": 1,
  "booking_code": "BKXYZ123AB",
  "user": {...},
  "court": {...},
  "date": "2026-04-30",
  "start_time": "09:00",
  "end_time": "11:00",
  "duration_hours": 2,
  "total_price": 200000,
  "status": "pending",
  "created_at": "2026-04-29T10:30:00.000000Z"
}
```

---

## 4. PUT - Update Booking
**Endpoint:** `PUT /api/bookings/{id}`

**Headers:**
```
Content-Type: application/json
```

**Request Body (partial update):**
```json
{
  "status": "approved",
  "total_price": 250000
}
```

**Response:**
```json
{
  "id": 1,
  "booking_code": "BKXYZ123AB",
  "user": {...},
  "court": {...},
  "date": "2026-04-30",
  "start_time": "09:00",
  "end_time": "11:00",
  "duration_hours": 2,
  "total_price": 250000,
  "status": "approved",
  "created_at": "2026-04-29T10:30:00.000000Z"
}
```

---

## 5. DELETE - Hapus Booking
**Endpoint:** `DELETE /api/bookings/{id}`

**Response:**
```json
{
  "message": "Booking berhasil dihapus"
}
```

---

## 6. POST - Approve Booking
**Endpoint:** `POST /api/bookings/{id}/approve`

**Response:**
```json
{
  "message": "Booking disetujui",
  "booking": {
    "id": 1,
    "status": "approved",
    ...
  }
}
```

---

## 7. POST - Reject Booking
**Endpoint:** `POST /api/bookings/{id}/reject`

**Response:**
```json
{
  "message": "Booking ditolak",
  "booking": {
    "id": 1,
    "status": "rejected",
    ...
  }
}
```

---

## 8. GET - Bookings by User
**Endpoint:** `GET /api/users/{userId}/bookings`

**Example:**
```
GET /api/users/1/bookings
```

**Response:**
```json
[
  {
    "id": 1,
    "booking_code": "BKXYZ123AB",
    ...
  },
  {
    "id": 2,
    "booking_code": "BKABC456XY",
    ...
  }
]
```

---

## Contoh Penggunaan dengan JavaScript/Fetch

### 1. Ambil Semua Bookings
```javascript
fetch('/api/bookings')
  .then(res => res.json())
  .then(data => console.log(data.data));
```

### 2. Create Booking
```javascript
fetch('/api/bookings', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  },
  body: JSON.stringify({
    user_id: 1,
    court_id: 1,
    date: '2026-04-30',
    start_time: '09:00',
    end_time: '11:00',
    duration_hours: 2,
    total_price: 200000
  })
})
.then(res => res.json())
.then(data => console.log(data));
```

### 3. Update Booking
```javascript
fetch('/api/bookings/1', {
  method: 'PUT',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  },
  body: JSON.stringify({
    status: 'approved'
  })
})
.then(res => res.json())
.then(data => console.log(data));
```

### 4. Delete Booking
```javascript
fetch('/api/bookings/1', {
  method: 'DELETE',
  headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  }
})
.then(res => res.json())
.then(data => console.log(data));
```

### 5. Approve Booking
```javascript
fetch('/api/bookings/1/approve', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  }
})
.then(res => res.json())
.then(data => console.log(data));
```

---

## Error Handling

Jika ada validasi error atau resource tidak ditemukan:

```json
{
  "message": "Validation failed",
  "errors": {
    "user_id": ["The user_id field is required."],
    "court_id": ["The court_id field must exist in courts table."]
  }
}
```

---

## Testing dengan Curl

```bash
# Get all bookings
curl http://localhost:8000/api/bookings

# Create booking
curl -X POST http://localhost:8000/api/bookings \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 1,
    "court_id": 1,
    "date": "2026-04-30",
    "start_time": "09:00",
    "end_time": "11:00",
    "duration_hours": 2,
    "total_price": 200000
  }'

# Update booking
curl -X PUT http://localhost:8000/api/bookings/1 \
  -H "Content-Type: application/json" \
  -d '{"status": "approved"}'

# Delete booking
curl -X DELETE http://localhost:8000/api/bookings/1

# Approve booking
curl -X POST http://localhost:8000/api/bookings/1/approve

# Get bookings by user
curl http://localhost:8000/api/users/1/bookings
```
