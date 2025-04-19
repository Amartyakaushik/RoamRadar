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
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Your Travel Recommendations</h2>
                        
                        <!-- User Input Summary -->
                        <div class="alert alert-info mb-4">
                            <h5 class="alert-heading">Your Travel Preferences</h5>
                            <p class="mb-1"><strong>Budget:</strong> ${{ number_format($budget, 2) }}</p>
                            <p class="mb-1"><strong>Travel Dates:</strong> {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
                            <p class="mb-0"><strong>Selected Activities:</strong> {{ implode(', ', $activities) }}</p>
                        </div>

                        @if(count($destinations) > 0)
                            <!-- Destinations Grid -->
                            <div class="row g-4">
                                @foreach($destinations as $destination)
                                    <div class="col-md-4">
                                        <div class="card h-100">
                                            <img src="{{ $destination['image'] }}" class="card-img-top" alt="{{ $destination['name'] }}" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $destination['name'] }}</h5>
                                                <p class="card-text">{{ $destination['description'] }}</p>
                                                <p class="card-text"><small class="text-muted">Estimated Cost: ${{ number_format($destination['cost'], 2) }}</small></p>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach($destination['tags'] as $tag)
                                                        <span class="badge bg-primary">{{ $tag }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-center gap-3 mt-4">
                                <form action="{{ route('recommendations.pdf') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="budget" value="{{ $budget }}">
                                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                                    @foreach($activities as $activity)
                                        <input type="hidden" name="activities[]" value="{{ $activity }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-download me-2"></i>Download PDF
                                    </button>
                                </form>

                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#emailModal">
                                    <i class="fas fa-envelope me-2"></i>Send to Email
                                </button>
                            </div>
                        @else
                            <div class="alert alert-warning text-center py-5">
                                <h4 class="mb-3">❌ No destinations found matching your criteria.</h4>
                                <p class="mb-0">Please try again with a different selection.</p>
                                <a href="{{ route('recommend') }}" class="btn btn-primary mt-3">Try Again</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('recommendations.email') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="emailModalLabel">Send Recommendations to Email</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <input type="hidden" name="budget" value="{{ $budget }}">
                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                        @foreach($activities as $activity)
                            <input type="hidden" name="activities[]" value="{{ $activity }}">
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Send Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>