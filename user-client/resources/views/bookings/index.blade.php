<div>
    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Booking Code</th>
            <th>Customer Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $book)
        <tr>
            <td>{{ $book['id'] }}</td>
            <td><strong>{{ $book['booking_code'] }}</strong></td>
            
            <td>{{ $book['user']['name'] }}</td>
            <td>{{ $book['user']['email'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table><!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
</div>
