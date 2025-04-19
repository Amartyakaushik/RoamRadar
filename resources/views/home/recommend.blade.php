<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Recommendations - RoamRadar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Find Your Perfect Destination</h2>
                        
                        <form action="{{ url('/recommend/results') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="budget" class="form-label">Budget (USD)</label>
                                <input type="number" class="form-control" id="budget" name="budget" min="0" step="100" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Travel Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">Travel End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Activities</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="activities[]" value="beach" id="beach">
                                            <label class="form-check-label" for="beach">Beach</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="activities[]" value="adventure" id="adventure">
                                            <label class="form-check-label" for="adventure">Adventure</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="activities[]" value="museums" id="museums">
                                            <label class="form-check-label" for="museums">Museums</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="activities[]" value="nightlife" id="nightlife">
                                            <label class="form-check-label" for="nightlife">Nightlife</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="activities[]" value="nature" id="nature">
                                            <label class="form-check-label" for="nature">Nature</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="activities[]" value="food" id="food">
                                            <label class="form-check-label" for="food">Food</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Find Destinations</button>
                                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back to Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 