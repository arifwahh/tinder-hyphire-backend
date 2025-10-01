{{-- resources/views/emails/popular_person.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Popular Person Alert</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #FF5864; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Popular Person Alert!</h1>
        </div>
        <div class="content">
            <p><strong>Name:</strong> {{ $person->name }}</p>
            <p><strong>Age:</strong> {{ $person->age }}</p>
            <p><strong>Location:</strong> {{ $person->location }}</p>
            <p><strong>Total Likes:</strong> <span style="color: #FF5864; font-weight: bold;">{{ $person->like_count }}</span></p>
            <p><strong>Profile Created:</strong> {{ $person->created_at->format('M j, Y') }}</p>
            
            <hr>
            <p>This person is getting very popular on your Tinder app! Consider featuring them or analyzing what makes them popular.</p>
        </div>
        <div class="footer">
            <p>Tinder App Notification System</p>
        </div>
    </div>
</body>
</html>