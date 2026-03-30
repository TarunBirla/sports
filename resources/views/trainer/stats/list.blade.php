@extends('vendor.layout')

@section('page_title', 'Student Stats List')

@section('content')
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet" />

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --green:        #1D9E75;
      --green-dark:   #0F6E56;
      --green-light:  #E1F5EE;
      --amber:        #BA7517;
      --amber-light:  #FAEEDA;
      --red:          #E24B4A;
      --blue:         #378ADD;
      --blue-light:   #E6F1FB;
      --bg:           #F7F6F2;
      --surface:      #FFFFFF;
      --surface2:     #F1EFE8;
      --border:       rgba(0,0,0,0.09);
      --border-md:    rgba(0,0,0,0.16);
      --text:         #1C1C1A;
      --text-muted:   #6B6A64;
      --text-faint:   #A09E97;
      --radius-sm:    6px;
      --radius-md:    10px;
      --radius-lg:    14px;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      padding: 2rem 1rem 4rem;
    }

    .page {
      max-width: 1000px;
      margin: 0 auto;
    }

    /* ── HEADER ── */
    .page-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 2rem;
    }

    .header-icon {
      width: 50px;
      height: 50px;
      background: var(--green);
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 4px 14px rgba(29,158,117,0.28);
    }

    .header-text h1 {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 30px;
      letter-spacing: 0.05em;
      font-weight: 400;
      line-height: 1;
    }

    .header-text p {
      font-size: 13px;
      color: var(--text-muted);
      margin-top: 4px;
    }

    .header-actions {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .count-badge {
      background: var(--green-light);
      color: var(--green-dark);
      font-size: 12px;
      font-weight: 500;
      padding: 5px 12px;
      border-radius: 100px;
      border: 1px solid rgba(29,158,117,0.2);
    }

    /* ── SEARCH BAR ── */
    .toolbar {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 1rem;
    }

    .search-wrap {
      position: relative;
      flex: 1;
      max-width: 280px;
    }

    .search-icon {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-faint);
    }

    .search-wrap input {
      width: 100%;
      height: 36px;
      padding: 0 10px 0 32px;
      border: 1px solid var(--border-md);
      border-radius: var(--radius-sm);
      background: var(--surface);
      font-family: 'DM Sans', sans-serif;
      font-size: 13.5px;
      color: var(--text);
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }

    .search-wrap input:focus {
      border-color: var(--green);
      box-shadow: 0 0 0 3px rgba(29,158,117,0.12);
    }

    .search-wrap input::placeholder { color: var(--text-faint); }

    /* ── CARD ── */
    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      overflow: hidden;
    }

    /* ── TABLE ── */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead tr {
      background: var(--surface2);
      border-bottom: 1px solid var(--border-md);
    }

    thead th {
      font-size: 11px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: var(--text-muted);
      padding: 12px 16px;
      text-align: left;
      white-space: nowrap;
    }

    thead th:first-child { width: 48px; text-align: center; }
    thead th:last-child  { text-align: center; width: 90px; }

    tbody tr {
      border-bottom: 1px solid var(--border);
      transition: background 0.12s;
    }

    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #FAFAF8; }

    tbody td {
      padding: 13px 16px;
      font-size: 14px;
      color: var(--text);
      vertical-align: middle;
    }

    tbody td:first-child {
      text-align: center;
      font-size: 12px;
      color: var(--text-faint);
      font-weight: 500;
    }

    tbody td:last-child { text-align: center; }

    /* ── PLAYER NAME CELL ── */
    .player-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: var(--green-light);
      color: var(--green-dark);
      font-size: 12px;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      border: 1px solid rgba(29,158,117,0.18);
    }

    .player-name {
      font-weight: 500;
      font-size: 14px;
    }

    /* ── STAT PILL ── */
    .stat {
      font-size: 13.5px;
      font-weight: 500;
      color: var(--text);
    }

    .stat-dash {
      color: var(--text-faint);
      font-size: 13px;
    }

    /* ── MINI BAR ── */
    .mini-bar-wrap { display: flex; align-items: center; gap: 8px; }

    .mini-bar-track {
      flex: 1;
      max-width: 70px;
      height: 4px;
      background: var(--border);
      border-radius: 2px;
      overflow: hidden;
    }

    .mini-bar-fill {
      height: 100%;
      border-radius: 2px;
      background: var(--green);
    }

    /* ── EDIT BUTTON ── */
    .btn-edit {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      height: 30px;
      padding: 0 12px;
      font-family: 'DM Sans', sans-serif;
      font-size: 12.5px;
      font-weight: 500;
      color: var(--green-dark);
      background: var(--green-light);
      border: 1px solid rgba(29,158,117,0.25);
      border-radius: var(--radius-sm);
      cursor: pointer;
      text-decoration: none;
      transition: background 0.13s, box-shadow 0.13s;
    }

    .btn-edit:hover {
      background: #c8edde;
      box-shadow: 0 2px 6px rgba(29,158,117,0.18);
    }

    /* ── EMPTY STATE ── */
    .empty-state {
      padding: 3rem 1rem;
      text-align: center;
    }

    .empty-icon {
      width: 52px;
      height: 52px;
      background: var(--surface2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
    }

    .empty-state p {
      font-size: 14px;
      color: var(--text-muted);
    }

    /* ── PAGINATION HINT ── */
    .table-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 16px;
      border-top: 1px solid var(--border);
      background: var(--surface2);
    }

    .table-footer span {
      font-size: 12px;
      color: var(--text-faint);
    }

    /* ── FADE IN ── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(8px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .page { animation: fadeUp 0.35s ease both; }

    /* ── RESPONSIVE ── */
    @media (max-width: 640px) {
      .mini-bar-track { display: none; }
      thead th:nth-child(5),
      tbody td:nth-child(5) { display: none; }
    }
  </style>
<div class="page">

  <!-- HEADER -->
  <div class="page-header">
    <div class="header-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="12" r="9" stroke="white" stroke-width="1.6"/>
        <path d="M7 17L12 7L17 17" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
        <line x1="8.8" y1="13.5" x2="15.2" y2="13.5" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
      </svg>
    </div>
    <div class="header-text">
      <h1>Student Stats List</h1>
      <p>Manage and review cricket performance records</p>
    </div>
    <div class="header-actions">
      <span class="count-badge" id="countBadge">6 players</span>
    </div>
  </div>

  <!-- TOOLBAR -->
  <div class="toolbar">
    <div class="search-wrap">
      <svg class="search-icon" width="14" height="14" viewBox="0 0 24 24" fill="none">
        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
        <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
      <input type="text" id="searchInput" placeholder="Search player..." oninput="filterTable()" />
    </div>
  </div>

  <!-- TABLE CARD -->
  <div class="card">
    <table id="statsTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Runs</th>
          <th>Wickets</th>
          <th>Matches</th>
          <th>Strike Rate</th>
          <th>Joined</th>
        </tr>
      </thead>
        <tbody id="tableBody">

            @forelse($records as $key => $row)

                <tr data-name="{{ $row->user->name ?? '' }}">
                    <td>{{ $key + 1 }}</td>

                    <td>
                        <div class="player-cell">
                            <div class="avatar">
                                {{ strtoupper(substr($row->user->name ?? 'U',0,1)) }}
                            </div>
                            <span class="player-name">
                                {{ $row->user->name ?? 'Unknown' }}
                            </span>
                        </div>
                    </td>

                    <td>
                        <span class="stat">{{ $row->runs ?? '-' }}</span>
                    </td>

                    <td>
                        <span class="stat">{{ $row->wickets ?? '-' }}</span>
                    </td>

                    <td>
                        <span class="stat">{{ $row->total_matches ?? '-' }}</span>
                    </td>

                    <td>
                        @if($row->strike_rate)
                            @php
                                $rate = $row->strike_rate;
                                $width = min(100, ($rate / 200) * 100);
                            @endphp

                            <div class="mini-bar-wrap">
                                <span class="stat">{{ $rate }}</span>
                                <div class="mini-bar-track">
                                    <div class="mini-bar-fill" style="width:{{ $width }}%"></div>
                                </div>
                            </div>
                        @else
                            <span class="stat-dash">—</span>
                        @endif
                    </td>

                    <td>
                        {{ $row->created_at->format('d M Y') }}
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <p>No records found</p>
                        </div>
                    </td>
                </tr>
            @endforelse

            <tr id="emptyRow" style="display:none;">
                <td colspan="8">
                    <div class="empty-state">
                        <p>No players found</p>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>

    <div class="table-footer">
      <span>Cricket Academy — 2026</span>
    </div>
  </div>

</div>

<script>
  function initials(name) {
    return name.split(' ').map(w => w[0]).join('').slice(0,2).toUpperCase();
  }

  function filterTable() {
    var q = document.getElementById('searchInput').value.toLowerCase();
    var rows = document.querySelectorAll('#tableBody tr[data-name]');
    var visible = 0;
    rows.forEach(function(row) {
      var name = row.getAttribute('data-name').toLowerCase();
      var show = name.includes(q);
      row.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    document.getElementById('emptyRow').style.display = visible === 0 ? '' : 'none';
    document.getElementById('countBadge').textContent = visible + ' player' + (visible !== 1 ? 's' : '');
    document.getElementById('footerText').textContent = 'Showing ' + visible + ' of ' + rows.length + ' players';
  }
</script>
@endsection