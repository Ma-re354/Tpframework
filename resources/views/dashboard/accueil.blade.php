@extends('dashboard.layout')

@section('content')
<section id="accueil" class="content-section active">
    <div class="section-header">
        <h1>Tableau de Bord</h1>
    </div>
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $usersCount ?? '1,254' }}</h3>
                <p>Utilisateurs</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $moderatorsCount ?? '24' }}</h3>
                <p>Modérateurs</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $contentsCount ?? '568' }}</h3>
                <p>Contenus</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-language"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $languagesCount ?? '5' }}</h3>
                <p>Langues</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $viewsCount ?? '12,458' }}</h3>
                <p>Vues</p>
            </div>
        </div>
    </div>
    <div class="recent-activity">
        <h2>Activité récente</h2>
        <div class="activity-list">
            @foreach($recentActivities ?? [] as $activity)
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas {{ $activity['icon'] }}"></i>
                </div>
                <div class="activity-details">
                    <p>{{ $activity['description'] }}</p>
                    <span class="activity-time">{{ $activity['time'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection