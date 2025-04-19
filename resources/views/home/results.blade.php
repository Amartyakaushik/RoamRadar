<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Recommendations - RoamRadar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .tag-badge {
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Your Travel Recommendations</h2>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong>Budget:</strong> ${{ number_format($budget, 2) }}</p>
                                <p><strong>Travel Dates:</strong> {{ date('F j, Y', strtotime($startDate)) }} - {{ date('F j, Y', strtotime($endDate)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Selected Activities:</strong></p>
                                <div>
                                    @foreach($activities as $activity)
                                        <span class="badge bg-primary me-2">{{ ucfirst($activity) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <form action="{{ route('recommend.pdf') }}" method="POST" class="mb-3">
                                    @csrf
                                    <input type="hidden" name="budget" value="{{ $budget }}">
                                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                                    @foreach($activities as $activity)
                                        <input type="hidden" name="activities[]" value="{{ $activity }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-file-pdf"></i> Download PDF
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('recommend.email') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="budget" value="{{ $budget }}">
                                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                                    @foreach($activities as $activity)
                                        <input type="hidden" name="activities[]" value="{{ $activity }}">
                                    @endforeach
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                        <button type="submit" class="btn btn-primary">Send to Email</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mb-4">
                            <a href="{{ url('/recommend') }}" class="btn btn-outline-primary">Modify Search</a>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back to Home</a>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                
                @if(count($destinations) > 0)
                    <div class="row">
                        @foreach($destinations as $destination)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ $destination['image'] }}" class="card-img-top" alt="{{ $destination['name'] }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $destination['name'] }}</h5>
                                        <p class="card-text">{{ $destination['description'] }}</p>
                                        <p class="card-text"><strong>Estimated Cost:</strong> ${{ number_format($destination['cost'], 2) }}</p>
                                        
                                        <div class="mb-3">
                                            @foreach($destination['tags'] as $tag)
                                                <span class="badge bg-info tag-badge">{{ ucfirst($tag) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <h4 class="alert-heading">No destinations found</h4>
                        <p>We couldn't find any destinations matching your criteria. Try adjusting your budget or selecting different activities.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>