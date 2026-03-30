@extends('vendor.layout')

@section('page_title', 'User List')

@section('content')
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;1,9..40,400&display=swap" rel="stylesheet" />

  <style>
    /* *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; } */

    :root {
      --green:       #1D9E75;
      --green-dark:  #0F6E56;
      --green-deep:  #085041;
      --green-light: #E1F5EE;
      --amber:       #BA7517;
      --amber-light: #FAEEDA;
      --blue:        #378ADD;
      --blue-light:  #E6F1FB;
      --red:         #E24B4A;
      --bg:          #F7F6F2;
      --surface:     #FFFFFF;
      --surface2:    #F1EFE8;
      --border:      rgba(0,0,0,0.10);
      --border-md:   rgba(0,0,0,0.18);
      --text:        #1C1C1A;
      --text-muted:  #6B6A64;
      --text-faint:  #A09E97;
      --radius-sm:   6px;
      --radius-md:   10px;
      --radius-lg:   14px;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      padding: 2rem 1rem 4rem;
    }

    /* ── PAGE WRAPPER ── */
    
    /* ── HEADER ── */
    .page-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 2.5rem;
    }

    .header-icon {
      width: 52px;
      height: 52px;
      background: var(--green);
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 4px 14px rgba(29,158,117,0.30);
    }

    .header-text h1 {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 32px;
      letter-spacing: 0.05em;
      font-weight: 400;
      line-height: 1;
      color: var(--text);
    }

    .header-text p {
      font-size: 13.5px;
      color: var(--text-muted);
      margin-top: 4px;
    }

    .badge {
      margin-left: auto;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--green-light);
      color: var(--green-dark);
      font-size: 12px;
      font-weight: 500;
      padding: 5px 12px;
      border-radius: 100px;
      border: 1px solid rgba(29,158,117,0.20);
      white-space: nowrap;
    }

    .badge-dot {
      width: 7px;
      height: 7px;
      background: var(--green);
      border-radius: 50%;
    }

    /* ── FORM ── */
    form { display: flex; flex-direction: column; gap: 1.5rem; }

    /* ── SECTION ── */
    .section {}

    .section-header {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 14px;
    }

    .section-pip {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      flex-shrink: 0;
    }

    .pip-green { background: var(--green); }
    .pip-amber { background: var(--amber); }
    .pip-blue  { background: var(--blue); }

    .section-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 18px;
      font-weight: 400;
      letter-spacing: 0.07em;
      color: var(--text);
    }

    .section-rule {
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    /* ── CARD ── */
    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 1.5rem;
    }

    /* ── GRIDS ── */
    .grid-perf {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
      gap: 14px 18px;
    }

    .grid-fitness {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px 18px;
    }

    .grid-attend {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px 18px;
    }

    /* ── FIELD GROUP ── */
    .field {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .field label {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 11px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: var(--text-muted);
    }

    .month-hint {
      font-size: 10px;
      font-weight: 400;
      text-transform: none;
      letter-spacing: 0;
      color: var(--text-faint);
    }

    input[type="text"],
    input[type="number"] {
      height: 38px;
      padding: 0 11px;
      border: 1px solid var(--border-md);
      border-radius: var(--radius-sm);
      background: var(--surface2);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      width: 100%;
      outline: none;
      transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
      -moz-appearance: textfield;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button { -webkit-appearance: none; }

    input:focus {
      border-color: var(--green);
      background: var(--surface);
      box-shadow: 0 0 0 3px rgba(29,158,117,0.13);
    }

    input::placeholder { color: var(--text-faint); font-size: 13px; }

    /* ── FITNESS BAR ── */
    .fitness-track {
      height: 4px;
      background: var(--border);
      border-radius: 2px;
      margin-top: 7px;
      overflow: hidden;
    }

    .fitness-fill {
      height: 100%;
      border-radius: 2px;
      width: 0%;
      background: var(--green);
      transition: width 0.2s ease, background 0.3s ease;
    }

    /* ── ACTIONS ── */
    .actions {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 10px;
      padding-top: 1.25rem;
      border-top: 1px solid var(--border);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      height: 40px;
      padding: 0 22px;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 500;
      border-radius: var(--radius-sm);
      border: 1px solid var(--border-md);
      cursor: pointer;
      transition: background 0.14s, transform 0.1s, box-shadow 0.14s;
      text-decoration: none;
    }

    .btn-ghost {
      background: transparent;
      color: var(--text-muted);
    }

    .btn-ghost:hover {
      background: var(--surface2);
      color: var(--text);
    }

    .btn-primary {
      background: var(--green);
      color: #fff;
      border-color: var(--green-dark);
      box-shadow: 0 2px 8px rgba(29,158,117,0.25);
    }

    .btn-primary:hover {
      background: var(--green-dark);
      box-shadow: 0 4px 14px rgba(29,158,117,0.35);
    }

    .btn-primary:active {
      transform: scale(0.98);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 640px) {
      .grid-perf { grid-template-columns: 1fr 1fr; }
      .grid-fitness { grid-template-columns: 1fr 1fr; }
      .grid-attend { grid-template-columns: 1fr 1fr; }
      .badge { display: none; }
    }

    @media (max-width: 420px) {
      .grid-perf { grid-template-columns: 1fr; }
    }

    /* ── FADE-IN ── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .section {
      animation: fadeUp 0.4s ease both;
    }

    .section:nth-child(1) { animation-delay: 0.05s; }
    .section:nth-child(2) { animation-delay: 0.12s; }
    .section:nth-child(3) { animation-delay: 0.19s; }
    .section:nth-child(4) { animation-delay: 0.26s; }
  </style>


<div class="page">
  <div class="page-header">
    <div class="header-icon">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="9" stroke="white" stroke-width="1.6"/>
        <path d="M7 17L12 7L17 17" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        <line x1="8.8" y1="13.5" x2="15.2" y2="13.5" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
      </svg>
    </div>
    <div class="header-text">
      <h1>Cricket Performance Stats</h1>
      <p>Update player stats, fitness levels and monthly attendance</p>
    </div>
    <div class="badge">
      <div class="badge-dot"></div>
      Active player
    </div>
  </div>

  <!-- FORM -->
  <form method="POST" action="{{ url('/student-stats/'.$userId) }}">
    @csrf

    
    <!-- PERFORMANCE -->
    <div class="section">
      <div class="section-header">
        <div class="section-pip pip-green"></div>
        <span class="section-title">Performance Stats</span>
        <div class="section-rule"></div>
      </div>
      <div class="card">
        <div class="grid-perf">

          <div class="field">
            <label>Runs</label>
            <input type="text" name="runs" id="runs" placeholder="e.g. 3420">
          </div>

          <div class="field">
            <label>Balls Faced</label>
            <input type="text" name="balls_faced" id="balls" placeholder="Balls faced">
          </div>

          <div class="field">
            <label>Total Matches</label>
            <input type="text" name="total_matches" id="matches" placeholder="e.g. 60">
          </div>

          <div class="field">
            <label>Batting Average</label>
            <input type="text" name="batting_average" id="batting_average" readonly placeholder="e.g. 38.6">
          </div>

          <div class="field">
            <label>Strike Rate</label>
            <input type="text" name="strike_rate" id="strike_rate" readonly placeholder="e.g. 132.4">
          </div>

          

          <div class="field">
            <label>Overs Bowled</label>
            <input type="text" name="overs_bowled" id="overs" placeholder="Overs bowled">
          </div>
          <div class="field">
            <label>Runs Conceded</label>
            <input type="text" name="runs_conceded" id="runs_conceded" placeholder="Runs conceded">
          </div>
          <div class="field">
            <label>Wickets</label>
            <input type="text" name="wickets"  id="wickets" placeholder="e.g. 45">
          </div>
          
          <div class="field">
            <label>Economy</label>
            <input type="text" name="economy" id="economy" readonly placeholder="e.g. 7.2">
          </div>

          


          

          

          <div class="field">
            <label>High Score</label>
            <input type="text" name="high_score" placeholder="e.g. 148*">
          </div>

          <div class="field">
            <label>Centuries</label>
            <input type="text" name="centuries" placeholder="e.g. 4">
          </div>

          <div class="field">
            <label>Half Centuries</label>
            <input type="text" name="half_centuries" placeholder="e.g. 12">
          </div>

          <div class="field">
            <label>Catches</label>
            <input type="text" name="catches" placeholder="e.g. 18">
          </div>

          <div class="field">
            <label>Best Bowling</label>
            <input type="text" name="best_bowling" placeholder="e.g. 5/22">
          </div>

          <div class="field">
            <label>Age</label>
            <input type="text" name="age" placeholder="e.g. 22">
          </div>

          <div class="field">
            <label>Batting Style</label>
            <input type="text" name="batting_style" placeholder="e.g. Right-hand">
          </div>

          <div class="field">
            <label>Bowling Style</label>
            <input type="text" name="bowling_style" placeholder="e.g. Off-spin">
          </div>

            <!-- <label>Academy</label> -->
            <input type="hidden" name="academy" value="Academy name" placeholder="Academy name">


        </div>
      </div>
    </div>

    <!-- FITNESS -->
    <div class="section">
      <div class="section-header">
        <div class="section-pip pip-amber"></div>
        <span class="section-title">Fitness Tracking</span>
        <div class="section-rule"></div>
      </div>
      <div class="card">
        <div class="grid-fitness">

          <div class="field">
            <label>Speed <span style="color:var(--text-faint);font-size:10px;text-transform:none;letter-spacing:0;">0–100</span></label>
            <input type="number" name="speed" min="0" max="100" placeholder="0" oninput="updateBar(this)">
            <div class="fitness-track"><div class="fitness-fill"></div></div>
          </div>

          <div class="field">
            <label>Stamina <span style="color:var(--text-faint);font-size:10px;text-transform:none;letter-spacing:0;">0–100</span></label>
            <input type="number" name="stamina" min="0" max="100" placeholder="0" oninput="updateBar(this)">
            <div class="fitness-track"><div class="fitness-fill"></div></div>
          </div>

          <div class="field">
            <label>Strength <span style="color:var(--text-faint);font-size:10px;text-transform:none;letter-spacing:0;">0–100</span></label>
            <input type="number" name="strength" min="0" max="100" placeholder="0" oninput="updateBar(this)">
            <div class="fitness-track"><div class="fitness-fill"></div></div>
          </div>

          <div class="field">
            <label>Agility <span style="color:var(--text-faint);font-size:10px;text-transform:none;letter-spacing:0;">0–100</span></label>
            <input type="number" name="agility" min="0" max="100" placeholder="0" oninput="updateBar(this)">
            <div class="fitness-track"><div class="fitness-fill"></div></div>
          </div>

          <div class="field">
            <label>Flexibility <span style="color:var(--text-faint);font-size:10px;text-transform:none;letter-spacing:0;">0–100</span></label>
            <input type="number" name="flexibility" min="0" max="100" placeholder="0" oninput="updateBar(this)">
            <div class="fitness-track"><div class="fitness-fill"></div></div>
          </div>

          <div class="field">
            <label>Endurance <span style="color:var(--text-faint);font-size:10px;text-transform:none;letter-spacing:0;">0–100</span></label>
            <input type="number" name="endurance" min="0" max="100" placeholder="0" oninput="updateBar(this)">
            <div class="fitness-track"><div class="fitness-fill"></div></div>
          </div>

        </div>
      </div>
    </div>

    <!-- ATTENDANCE -->
    <div class="section">
      <div class="section-header">
        <div class="section-pip pip-blue"></div>
        <span class="section-title">Monthly Attendance</span>
        <div class="section-rule"></div>
      </div>
      <div class="card">
        <div class="grid-attend">

          <div class="field">
            <label>Current Month <span class="month-hint">{{ date('F') }}</span></label>
            <input type="number" name="attendance[1]" placeholder="Sessions" min="0">
          </div>

          {{-- <div class="field">
            <label>Month 2 <span class="month-hint">Feb</span></label>
            <input type="number" name="attendance[2]" placeholder="Sessions" min="0">
          </div>

          <div class="field">
            <label>Month 3 <span class="month-hint">Mar</span></label>
            <input type="number" name="attendance[3]" placeholder="Sessions" min="0">
          </div>

          <div class="field">
            <label>Month 4 <span class="month-hint">Apr</span></label>
            <input type="number" name="attendance[4]" placeholder="Sessions" min="0">
          </div>

          <div class="field">
            <label>Month 5 <span class="month-hint">May</span></label>
            <input type="number" name="attendance[5]" placeholder="Sessions" min="0">
          </div>

          <div class="field">
            <label>Month 6 <span class="month-hint">Jun</span></label>
            <input type="number" name="attendance[6]" placeholder="Sessions" min="0">
          </div>

          <div class="field">
            <label>Month 7 <span class="month-hint">Jul</span></label>
            <input type="number" name="attendance[7]" placeholder="Sessions" min="0">
          </div>

          <div class="field">
            <label>Month 8 <span class="month-hint">Aug</span></label>
            <input type="number" name="attendance[8]" placeholder="Sessions" min="0">
          </div> --}}

        </div>
      </div>
    </div>

    <!-- ACTIONS -->
    <div class="section">
      <div class="actions">
        <a href="#" class="btn btn-ghost">Cancel</a>
        <button type="submit" class="btn btn-primary">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <polyline points="17,21 17,13 7,13 7,21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <polyline points="7,3 7,8 15,8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Save All Stats
        </button>
      </div>
    </div>

  </form>
</div>

<script>

function calculateStats() {

    let runs = parseFloat(document.getElementById('runs').value) || 0;
    let matches = parseFloat(document.getElementById('matches').value) || 0;
    let balls = parseFloat(document.getElementById('balls').value) || 0;

    let overs = parseFloat(document.getElementById('overs').value) || 0;
    let runsConceded = parseFloat(document.getElementById('runs_conceded').value) || 0;

    // ✅ Batting Average = Runs / Matches
    let avg = matches > 0 ? (runs / matches).toFixed(2) : 0;

    // ✅ Strike Rate = (Runs / Balls) * 100
    let sr = balls > 0 ? ((runs / balls) * 100).toFixed(2) : 0;

    // ✅ Economy = Runs Conceded / Overs
    let eco = overs > 0 ? (runsConceded / overs).toFixed(2) : 0;

    document.getElementById('batting_average').value = avg;
    document.getElementById('strike_rate').value = sr;
    document.getElementById('economy').value = eco;
}

// trigger on input
document.querySelectorAll('#runs, #matches, #balls, #overs, #runs_conceded')
.forEach(el => {
    el.addEventListener('input', calculateStats);
});

</script>

<script>
  function updateBar(input) {
    var val = Math.min(100, Math.max(0, parseInt(input.value) || 0));
    var fill = input.parentElement.querySelector('.fitness-fill');
    if (!fill) return;
    fill.style.width = val + '%';
    if (val >= 70)      fill.style.background = '#1D9E75';
    else if (val >= 40) fill.style.background = '#BA7517';
    else                fill.style.background = '#E24B4A';
  }
</script>

@endsection