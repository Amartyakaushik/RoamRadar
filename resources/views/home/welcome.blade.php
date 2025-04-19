<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RoamRadar - Your Travel Companion</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|inter:400,500,600,700" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Add direct styles for immediate visual enhancement -->
        <style>
            body {
                background: linear-gradient(135deg, #f6f8ff 0%, #f0f3ff 100%);
                color: #333;
            }
            
            .nav-container {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .hero-section {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                color: white;
                padding: 120px 0;
                position: relative;
                overflow: hidden;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .hero-content {
                position: relative;
                z-index: 1;
                animation: fadeIn 1s ease-out;
            }

            .feature-card {
                background: white;
                border-radius: 16px;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                border: 1px solid rgba(99, 102, 241, 0.1);
            }

            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                border-color: rgba(99, 102, 241, 0.3);
            }

            .cta-section {
                background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
                color: white;
                padding: 80px 0;
                position: relative;
                overflow: hidden;
            }

            .cta-button {
                background: white;
                color: #4f46e5;
                padding: 1rem 2rem;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
            }

            .cta-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .gradient-text {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                font-weight: bold;
            }

            .nav-link {
                color: #4f46e5;
                text-decoration: none;
                padding: 0.5rem 1rem;
                border-radius: 6px;
                transition: all 0.3s ease;
            }

            .nav-link:hover {
                background: rgba(99, 102, 241, 0.1);
            }

            .register-button {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .register-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="nav-container fixed w-full z-50 px-6 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="/" class="text-2xl gradient-text">RoamRadar</a>
                <div class="flex items-center space-x-6">
                    <a href="/recommend" class="nav-link">Recommend</a>
                    <a href="#features" class="nav-link">Features</a>
                    <a href="#contact" class="register-button">Contact</a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content max-w-7xl mx-auto px-6 text-center">
                <h1 class="text-5xl sm:text-7xl font-bold mb-8">
                    Discover Your Next
                    <span class="block mt-2">Adventure</span>
                </h1>
                <p class="text-xl sm:text-2xl text-gray-100 mb-12 max-w-3xl mx-auto">
                    Plan your trips, explore new destinations, and create unforgettable memories with RoamRadar.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="/recommend" class="cta-button">
                        Start Planning
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-24 px-6" id="features">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-4 gradient-text">Why Choose RoamRadar?</h2>
                    <p class="text-xl text-gray-600">Everything you need to plan your perfect trip</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature Cards -->
                    <div class="feature-card">
                        <div class="text-4xl mb-6">🌍</div>
                        <h3 class="text-2xl font-semibold mb-4">Smart Trip Planning</h3>
                        <p class="text-gray-600">AI-powered recommendations and personalized itineraries based on your preferences.</p>
                    </div>
                    <div class="feature-card">
                        <div class="text-4xl mb-6">👥</div>
                        <h3 class="text-2xl font-semibold mb-4">Community Insights</h3>
                        <p class="text-gray-600">Connect with fellow travelers and get authentic recommendations from locals.</p>
                    </div>
                    <div class="feature-card">
                        <div class="text-4xl mb-6">🛡️</div>
                        <h3 class="text-2xl font-semibold mb-4">Safe Travel</h3>
                        <p class="text-gray-600">Real-time safety updates and emergency assistance available 24/7.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section" id="contact">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold mb-8">Ready to start your journey?</h2>
                <p class="text-xl mb-12">Start planning your next adventure today.</p>
                <a href="/recommend" class="cta-button">
                    Plan Your Trip
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-6 text-center text-gray-600">
                <p>&copy; {{ date('Y') }} RoamRadar. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
