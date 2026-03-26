@extends('vendor.layout')

@section('page_title', 'Add training')

@section('content')


<style>
    :root {
        --primary: #2563eb;
        --accent: #10b981;
        --danger: #ef4444;
        --border: #e5e7eb;
        --text: #111827;
        --text-muted: #6b7280;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 2rem 1rem;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .alert {
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border-left: 4px solid;
    }

    .alert-success {
        background: #ecfdf5;
        border-left-color: var(--accent);
        color: #065f46;
    }

    .alert-danger {
        background: #fef2f2;
        border-left-color: var(--danger);
        color: #7f1d1d;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .form-header h3 {
        margin: 0;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-body {
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2.5rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--border);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-icon {
        font-size: 1.5rem;
    }

    .fields-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .form-field {
        display: flex;
        flex-direction: column;
    }

    .field-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .field-icon {
        font-size: 1.1rem;
    }

    .form-input {
        padding: 0.75rem 1rem;
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input.is-invalid {
        border-color: var(--danger);
        background: rgba(239, 68, 68, 0.02);
    }

    .form-error {
        color: var(--danger);
        font-size: 0.8rem;
        margin-top: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding-top: 2rem;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), #1e40af);
        color: white;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }

    .btn-primary:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
    }

    .btn-secondary {
        background: white;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-secondary:hover {
        background: var(--primary);
        color: white;
    }

    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .form-info {
        background: rgba(37, 99, 235, 0.05);
        border-left: 4px solid var(--primary);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .field-hint {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 0.4rem;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .form-body {
            padding: 1.5rem;
        }

        .fields-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container">

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">📊 Enter Athlete Stats</h1>
        <p style="color: var(--text-muted); margin: 0;">
            Record and track performance metrics for comprehensive athlete analysis
        </p>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠️ Please fix the following errors:</strong>
            <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Form -->
    <form method="POST" action="{{ route('trainer.stats.store') }}" novalidate>
        @csrf

        <!-- Hidden Fields -->
        <input type="hidden" name="category_id" value="{{ $categoryId }}">
        <input type="hidden" name="user_id" value="{{ $user->id ?? 1 }}">

        <!-- Form Card -->
        <div class="form-card">

            <!-- Form Header -->
            <div class="form-header">
                <h3>
                    📋 {{ $category->name ?? 'Performance Metrics' }}
                </h3>
                <p style="margin: 0.5rem 0 0 0; color: var(--text-muted); font-size: 0.9rem;">
                    @if($user)
                        Recording stats for <strong>{{ $user->name }}</strong>
                    @endif
                </p>
            </div>

            <!-- Form Body -->
            <div class="form-body">

                <!-- Info Box -->
                <div class="form-info">
                    ℹ️ Enter accurate measurements for each metric. All values will be saved to the athlete's profile and used for performance analysis.
                </div>

                <!-- DYNAMIC FIELDS SECTION -->
                @if($fields->isNotEmpty())
                    <div class="form-section">
                        <h2 class="section-title">
                            <span class="section-icon">📈</span>
                            Performance Fields
                        </h2>

                        <div class="fields-grid">
                            @foreach($fields as $field)
                                <div class="form-field">
                                    <label class="field-label">
                                        <span class="field-icon">
                                            @switch($field->type)
                                                @case('speed')
                                                    ⚡
                                                    @break
                                                @case('endurance')
                                                    💪
                                                    @break
                                                @case('agility')
                                                    🏃
                                                    @break
                                                @default
                                                    📊
                                            @endswitch
                                        </span>
                                        {{ $field->name }}
                                    </label>

                                    <input 
                                        type="number" 
                                        name="fields[{{ $field->id }}]" 
                                        class="form-input @error("fields.{$field->id}") is-invalid @enderror"
                                        placeholder="Enter value"
                                        step="0.01"
                                        @if($field->min_value) min="{{ $field->min_value }}" @endif
                                        @if($field->max_value) max="{{ $field->max_value }}" @endif
                                    >

                                    @if($field->unit)
                                        <div class="field-hint">
                                            Unit: {{ $field->unit }}
                                        </div>
                                    @endif

                                    @error("fields.{$field->id}")
                                        <div class="form-error">⚠️ {{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- FITNESS TRACKING SECTION -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">💪</span>
                        Fitness Tracking
                    </h2>

                    <div class="fields-grid">
                        @php
                            $fitnessFields = [
                                'speed' => '⚡ Speed',
                                'stamina' => '🫁 Stamina',
                                'strength' => '🏋️ Strength',
                                'agility' => '🏃 Agility',
                                'flexibility' => '🤸 Flexibility',
                                'endurance' => '💨 Endurance'
                            ];
                        @endphp

                        @foreach($fitnessFields as $field => $label)
                            <div class="form-field">
                                <label class="field-label">{{ $label }}</label>
                                <input 
                                    type="number" 
                                    name="fitness[{{ $field }}]" 
                                    class="form-input @error("fitness.{$field}") is-invalid @enderror"
                                    placeholder="0 - 100"
                                    min="0"
                                    max="100"
                                    step="0.01"
                                >
                                <div class="field-hint">0-100 points</div>
                                @error("fitness.{$field}")
                                    <div class="form-error">⚠️ {{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ATTENDANCE SECTION -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="section-icon">📅</span>
                        Weekly Attendance
                    </h2>

                    <div class="fields-grid">
                        @for($week = 1; $week <= 8; $week++)
                            <div class="form-field">
                                <label class="field-label">
                                    📍 Week {{ $week }}
                                </label>
                                <input 
                                    type="number" 
                                    name="attendance[W{{ $week }}]" 
                                    class="form-input @error("attendance.W{$week}") is-invalid @enderror"
                                    placeholder="Sessions attended"
                                    min="0"
                                    max="20"
                                >
                                <div class="field-hint">Sessions attended</div>
                                @error("attendance.W{{ $week }}")
                                    <div class="form-error">⚠️ {{ $message }}</div>
                                @enderror
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('trainer.stats.index') }}" class="btn btn-secondary">
                    ← Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    💾 Save All Stats
                </button>
            </div>

        </div>

    </form>

</div>

<script>
    // Form validation on submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const inputs = this.querySelectorAll('input[type="number"]');
        let hasValues = false;

        inputs.forEach(input => {
            if (input.value && input.value > 0) {
                hasValues = true;
            }
        });

        if (!hasValues) {
            e.preventDefault();
            alert('Please enter at least one value before submitting.');
        }
    });
</script>

@endsection