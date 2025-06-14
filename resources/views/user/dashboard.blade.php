

@extends('layouts.app')

@section('title', 'Dashboard Sistem Prediksi Cabai')

@section('content')
    <div class=" fade-in container-fluid mb-5 ">
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
        </div>

        <div class="stats-grid">
            <div class="stat-card healthy">
                <div class="stat-header">
                    <div class="stat-icon">🌱</div>
                    <div class="stat-trend">
                        ↗️ +12%
                    </div>
                </div>
                <div class="stat-number" id="healthyCount">0</div>
                <div class="stat-label">Tanaman Sehat</div>
            </div>

            <div class="stat-card diseased">
                <div class="stat-header">
                    <div class="stat-icon">🦠</div>
                    <div class="stat-trend" style="color: #ef4444;">
                        ↘️ -8%
                    </div>
                </div>
                <div class="stat-number" id="diseasedCount">0</div>
                <div class="stat-label">Tanaman Terinfeksi</div>
            </div>

            <div class="stat-card predicted">
                <div class="stat-header">
                    <div class="stat-icon">🔍</div>
                    <div class="stat-trend">
                        ↗️ +24%
                    </div>
                </div>
                <div class="stat-number" id="predictedCount">0</div>
                <div class="stat-label">Prediksi Hari Ini</div>
            </div>

            <div class="stat-card accuracy">
                <div class="stat-header">
                    <div class="stat-icon">🎯</div>
                    <div class="stat-trend">
                        ↗️ +2%
                    </div>
                </div>
                <div class="stat-number" id="accuracyRate">0</div>
                <div class="stat-label">Akurasi Model</div>
            </div>
        </div>

        <div class="main-grid">
            <div class="chart-section">
                <h2 class="section-title">
                    📊 Tren Deteksi Penyakit (30 Hari Terakhir)
                </h2>
                <div class="chart-container">
                    <canvas id="trendChart" width="800" height="300"></canvas>
                </div>
                <div style="display: flex; justify-content: center; gap: 2rem; margin-top: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #10b981; border-radius: 50%;"></div>
                        <span style="font-size: 0.875rem; color: #4a5568;">Sehat</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #ef4444; border-radius: 50%;"></div>
                        <span style="font-size: 0.875rem; color: #4a5568;">Terinfeksi</span>
                    </div>
                </div>
            </div>

            <div class="recent-predictions">
                <h2 class="section-title">
                    🕒 Prediksi Terbaru
                </h2>
                
                <div class="prediction-item latest">
                    <div class="prediction-image">🌶️</div>
                    <div class="prediction-details">
                        <div class="prediction-disease">Antraknosa</div>
                        <div class="prediction-confidence">Confidence: 94%</div>
                        <div class="prediction-time">2 menit yang lalu</div>
                        <div class="confidence-bar">
                            <div class="confidence-fill" style="width: 94%;"></div>
                        </div>
                    </div>
                </div>

                <div class="prediction-item">
                    <div class="prediction-image">🌿</div>
                    <div class="prediction-details">
                        <div class="prediction-disease">Sehat</div>
                        <div class="prediction-confidence">Confidence: 98%</div>
                        <div class="prediction-time">8 menit yang lalu</div>
                        <div class="confidence-bar">
                            <div class="confidence-fill" style="width: 98%;"></div>
                        </div>
                    </div>
                </div>

                <div class="prediction-item">
                    <div class="prediction-image">🍃</div>
                    <div class="prediction-details">
                        <div class="prediction-disease">Layu Bakteri</div>
                        <div class="prediction-confidence">Confidence: 89%</div>
                        <div class="prediction-time">25 menit yang lalu</div>
                        <div class="confidence-bar">
                            <div class="confidence-fill" style="width: 89%;"></div>
                        </div>
                    </div>
                </div>

                <div class="prediction-item">
                    <div class="prediction-image">🌱</div>
                    <div class="prediction-details">
                        <div class="prediction-disease">Virus Mosaik</div>
                        <div class="prediction-confidence">Confidence: 91%</div>
                        <div class="prediction-time">1 jam yang lalu</div>
                        <div class="confidence-bar">
                            <div class="confidence-fill" style="width: 91%;"></div>
                        </div>
                    </div>
                </div>

                <div class="prediction-item">
                    <div class="prediction-image">🌿</div>
                    <div class="prediction-details">
                        <div class="prediction-disease">Sehat</div>
                        <div class="prediction-confidence">Confidence: 96%</div>
                        <div class="prediction-time">2 jam yang lalu</div>
                        <div class="confidence-bar">
                            <div class="confidence-fill" style="width: 96%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="disease-info">
            <h3>⚠️ Jenis Penyakit yang Terdeteksi Bulan Ini</h3>
            <div class="disease-list">
                <div class="disease-item">
                    <div class="disease-icon">🦠</div>
                    <div class="disease-name">Antraknosa</div>
                    <div class="disease-count">18 kasus</div>
                </div>
                <div class="disease-item">
                    <div class="disease-icon">🍂</div>
                    <div class="disease-name">Layu Bakteri</div>
                    <div class="disease-count">12 kasus</div>
                </div>
                <div class="disease-item">
                    <div class="disease-icon">🌀</div>
                    <div class="disease-name">Virus Mosaik</div>
                    <div class="disease-count">8 kasus</div>
                </div>
                <div class="disease-item">
                    <div class="disease-icon">🔴</div>
                    <div class="disease-name">Bercak Daun</div>
                    <div class="disease-count">5 kasus</div>
                </div>
            </div>
        </div>

        <div class="action-section">
            <h2 class="section-title">
                🚀 Aksi Cepat
            </h2>
            <div class="action-grid">
                <button class="action-btn" onclick="startPrediction()">
                    📸 Mulai Prediksi Baru
                </button>
                <button class="action-btn secondary" onclick="viewHistory()">
                    📋 Riwayat Prediksi
                </button>
                <button class="action-btn tertiary" onclick="viewReports()">
                    📊 Laporan Bulanan
                </button>
                <button class="action-btn quaternary" onclick="exportData()">
                    📤 Export Data
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Sample data for the chart
    const chartData = {
        sehat: [45, 52, 48, 61, 55, 67, 59, 68, 62, 70, 66, 74, 71, 78, 75, 82, 79, 85, 81, 88, 84, 90, 87, 93, 89, 95, 92, 98, 94, 96],
        sakit: [15, 12, 18, 9, 14, 8, 16, 7, 13, 6, 11, 5, 9, 4, 8, 3, 7, 2, 6, 4, 5, 3, 4, 2, 3, 1, 2, 1, 3, 2],
        labels: []
    };

    // Generate labels for last 30 days
    for (let i = 29; i >= 0; i--) {
        const date = new Date();
        date.setDate(date.getDate() - i);
        chartData.labels.push(date.getDate());
    }

    // Chart drawing function
    function drawChart() {
        const canvas = document.getElementById('trendChart');
        if (!canvas) return;
        
        const ctx = canvas.getContext('2d');
        const rect = canvas.parentElement.getBoundingClientRect();
        
        canvas.width = rect.width - 40;
        canvas.height = 300;
        
        const width = canvas.width - 80;
        const height = canvas.height - 80;
        const startX = 50;
        const startY = 30;
        
        // Clear canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Background
        const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
        gradient.addColorStop(0, 'rgba(102, 126, 234, 0.05)');
        gradient.addColorStop(1, 'rgba(118, 75, 162, 0.05)');
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Grid
        ctx.strokeStyle = 'rgba(203, 213, 224, 0.5)';
        ctx.lineWidth = 1;
        
        const maxValue = Math.max(...chartData.sehat, ...chartData.sakit) + 10;
        const dataLength = chartData.sehat.length;
        
        // Horizontal grid lines
        for (let i = 0; i <= 5; i++) {
            const y = startY + (i * (height / 5));
            ctx.beginPath();
            ctx.moveTo(startX, y);
            ctx.lineTo(startX + width, y);
            ctx.stroke();
            
            // Y-axis labels
            ctx.fillStyle = '#718096';
            ctx.font = '12px Arial';
            ctx.textAlign = 'right';
            ctx.fillText(Math.round(maxValue - (i * maxValue / 5)), startX - 10, y + 4);
        }
        
        // Vertical grid lines
        for (let i = 0; i < dataLength; i += 5) {
            const x = startX + (i * (width / (dataLength - 1)));
            ctx.beginPath();
            ctx.moveTo(x, startY);
            ctx.lineTo(x, startY + height);
            ctx.stroke();
            
            // X-axis labels
            if (i % 5 === 0) {
                ctx.fillStyle = '#718096';
                ctx.font = '11px Arial';
                ctx.textAlign = 'center';
                ctx.fillText(chartData.labels[i], x, startY + height + 20);
            }
        }
        
        // Draw area and line for healthy plants
        function drawAreaLine(data, fillColor, strokeColor) {
            ctx.beginPath();
            ctx.moveTo(startX, startY + height);
            
            for (let i = 0; i < data.length; i++) {
                const x = startX + (i * (width / (data.length - 1)));
                const y = startY + height - ((data[i] / maxValue) * height);
                ctx.lineTo(x, y);
            }
            
            ctx.lineTo(startX + width, startY + height);
            ctx.closePath();
            
            // Fill area
            ctx.fillStyle = fillColor;
            ctx.fill();
            
            // Draw line
            ctx.beginPath();
            for (let i = 0; i < data.length; i++) {
                const x = startX + (i * (width / (data.length - 1)));
                const y = startY + height - ((data[i] / maxValue) * height);
                
                if (i === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            }
            
            ctx.strokeStyle = strokeColor;
            ctx.lineWidth = 3;
            ctx.stroke();
            
            // Draw points
            for (let i = 0; i < data.length; i++) {
                const x = startX + (i * (width / (data.length - 1)));
                const y = startY + height - ((data[i] / maxValue) * height);
                
                ctx.beginPath();
                ctx.arc(x, y, 4, 0, Math.PI * 2);
                ctx.fillStyle = strokeColor;
                ctx.fill();
            }
        }
        
        // Draw healthy plants data
        drawAreaLine(chartData.sehat, 'rgba(16, 185, 129, 0.1)', '#10b981');
        
        // Draw diseased plants data
        drawAreaLine(chartData.sakit, 'rgba(239, 68, 68, 0.1)', '#ef4444');
    }

    // Counter animation
    function animateCounter(elementId, targetValue, suffix = '', duration = 2000) {
        const element = document.getElementById(elementId);
        if (!element) return;
        
        const startValue = 0;
        const increment = targetValue / (duration / 16);
        let currentValue = startValue;
        
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= targetValue) {
                currentValue = targetValue;
                clearInterval(timer);
            }
            element.textContent = Math.floor(currentValue) + suffix;
        }, 16);
    }

    // Button functions
    function startPrediction() {
        alert('Membuka modul prediksi baru...\n\nFitur ini akan mengarahkan ke halaman upload gambar untuk analisis AI.');
    }

    function viewHistory() {
        alert('Membuka riwayat prediksi...\n\nFitur ini akan menampilkan semua prediksi yang pernah dilakukan.');
    }

    function viewReports() {
        alert('Membuka laporan bulanan...\n\nFitur ini akan menampilkan laporan analisis komprehensif.');
    }

    function exportData() {
        alert('Export data...\n\nFitur ini akan mengunduh data dalam format CSV atau Excel.');
    }

    // Update statistics
    function updateStats() {
        const stats = {
            healthy: 156,
            diseased: 34,
            predicted: 67,
            accuracy: 94
        };
        
        animateCounter('healthyCount', stats.healthy);
        animateCounter('diseasedCount', stats.diseased);
        animateCounter('predictedCount', stats.predicted);
        animateCounter('accuracyRate', stats.accuracy, '%');
    }

    // Auto-update predictions
    function updatePredictions() {
        const predictions = document.querySelectorAll('.prediction-item');
        predictions.forEach((item, index) => {
            if (index === 0) {
                item.classList.add('latest');
            } else {
                item.classList.remove('latest');
            }
        });
    }

    // Initialize dashboard
    window.addEventListener('load', () => {
        setTimeout(() => {
            drawChart();
            updateStats();
        }, 500);
        
        // Auto-update every 30 seconds
        setInterval(() => {
            updateStats();
            updatePredictions();
        }, 30000);
    });

    // Responsive chart
    window.addEventListener('resize', () => {
        setTimeout(drawChart, 100);
    });

    // Simulate real-time updates
    setInterval(() => {
        const elements = document.querySelectorAll('.confidence-fill');
        // This is a placeholder for real-time updates
    }, 5000);
</script>
@endsection