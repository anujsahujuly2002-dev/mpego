@extends('admin.layouts.master')
@push('title')
    Accident Image List
@endpush

@push('css')
    <style>
        .image-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
        }
        .image-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .image-wrapper {
            position: relative;
            padding-top: 75%; /* 4:3 Aspect Ratio */
            overflow: hidden;
        }
        .image-card img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .image-card:hover img {
            transform: scale(1.1);
        }
        .image-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        .image-card:hover .image-actions {
            opacity: 1;
            transform: translateY(0);
        }
        .image-actions .btn {
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 20px;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.2s ease;
        }
        .image-actions .btn:hover {
            background: rgba(255, 255, 255, 0.9) !important;
            color: #000;
            transform: scale(1.05);
        }
        .image-actions .btn i {
            font-size: 16px;
        }
        
        /* Enhanced Image Preview Modal */
        .preview-modal {
            padding-left: 0 !important;
        }
        .preview-modal .modal-dialog {
            margin: 0;
            max-width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .preview-modal .modal-content {
            background-color: rgba(0, 0, 0, 0.95);
            border: none;
            height: 100vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
        }
        .preview-modal .modal-header {
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 2rem;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .preview-modal .modal-title {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 500;
            margin: 0;
        }
        .preview-modal .btn-close {
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            opacity: 0.8;
            transition: all 0.2s ease;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .preview-modal .btn-close:hover {
            background: rgba(255, 255, 255, 0.2);
            opacity: 1;
            transform: translateY(-50%) scale(1.1);
        }
        .preview-modal .btn-close:focus {
            box-shadow: none;
            outline: none;
        }
        .preview-modal .btn-close::before {
            content: '×';
            font-size: 24px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
        .preview-modal .modal-body {
            padding: 0;
            position: relative;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .preview-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
        }
        #previewImage {
            max-height: calc(100vh - 150px);
            max-width: 100%;
            object-fit: contain;
            transition: all 0.3s ease;
            cursor: grab;
        }
        #previewImage:active {
            cursor: grabbing;
        }
        .preview-controls {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1060;
            display: flex;
            gap: 15px;
            background: rgba(0, 0, 0, 0.8);
            padding: 15px 25px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }
        .preview-controls button {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            position: relative;
        }
        .preview-controls button:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .preview-controls button:active {
            transform: translateY(0);
        }
        .preview-controls button i {
            font-size: 1.2rem;
        }
        .preview-controls button::after {
            content: attr(title);
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }
        .preview-controls button:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: -30px;
        }
        .zoom-level {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .zoom-level.visible {
            opacity: 1;
        }
        
        /* Loading animation */
        .preview-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            display: none;
        }
        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
@endpush

@section('content')
    <div class="page-container">
        @if ($accident->accidentSeceneImages->count()>0)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Accident Scence Image List</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                @foreach($accident->accidentSeceneImages as $image)
                                    <div class="col-md-4 col-lg-3">
                                        <div class="image-card">
                                            <div class="image-wrapper">
                                                <img src="{{$image->images}}" alt="Accident Image" loading="lazy">
                                                <div class="image-actions">
                                                    <button class="btn btn-sm" onclick="viewImage('{{$image->images}}')" title="View Image">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($accident->vehicalDahicalImages->count()>0)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Vehical Damge Image List</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                @foreach($accident->vehicalDahicalImages as $image)
                                    <div class="col-md-4 col-lg-3">
                                        <div class="image-card">
                                            <div class="image-wrapper">
                                                <img src="{{$image->images}}" alt="Accident Image" loading="lazy">
                                                <div class="image-actions">
                                                    <button class="btn btn-sm" onclick="viewImage('{{$image->images}}')" title="View Image">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @if ($accident->carSeatsImages->count()>0)        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Car Seats Image List</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                @foreach($accident->carSeatsImages as $image)
                                    <div class="col-md-4 col-lg-3">
                                        <div class="image-card">
                                            <div class="image-wrapper">
                                                <img src="{{$image->images}}" alt="Accident Image" loading="lazy">
                                                <div class="image-actions">
                                                    <button class="btn btn-sm" onclick="viewImage('{{$image->images}}')" title="View Image">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($accident->repairEstimateImages->count()>0)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Repair Estimate Image List</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                @foreach($accident->repairEstimateImages as $image)
                                    <div class="col-md-4 col-lg-3">
                                        <div class="image-card">
                                            <div class="image-wrapper">
                                                <img src="{{$image->images}}" alt="Accident Image" loading="lazy">
                                                <div class="image-actions">
                                                    <button class="btn btn-sm" onclick="viewImage('{{$image->images}}')" title="View Image">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($accident->InjuryImages->count()>0)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 flex-grow-1">Repair Estimate Image List</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                @foreach($accident->InjuryImages as $image)
                                    <div class="col-md-4 col-lg-3">
                                        <div class="image-card">
                                            <div class="image-wrapper">
                                                <img src="{{$image->images}}" alt="Accident Image" loading="lazy">
                                                <div class="image-actions">
                                                    <button class="btn btn-sm" onclick="viewImage('{{$image->images}}')" title="View Image">
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

   
    <!-- Enhanced Image Preview Modal -->
    <div class="modal fade preview-modal" id="viewImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ti ti-photo me-2"></i>
                        Image Preview
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="preview-container" id="previewContainer">
                        <div class="preview-loading"></div>
                        <img id="previewImage" src="" alt="Preview">
                    </div>
                    <div class="zoom-level" id="zoomLevel">100%</div>
                    <div class="preview-controls">
                        <button onclick="zoomOut()" title="Zoom Out">
                            <i class="ti ti-zoom-out"></i>
                        </button>
                        <button onclick="resetZoom()" title="Reset View">
                            <i class="ti ti-zoom-cancel"></i>
                        </button>
                        <button onclick="zoomIn()" title="Zoom In">
                            <i class="ti ti-zoom-in"></i>
                        </button>
                        <button onclick="rotateImage()" title="Rotate">
                            <i class="ti ti-rotate"></i>
                        </button>
                        <button onclick="toggleFullscreen()" title="Fullscreen">
                            <i class="ti ti-maximize"></i>
                        </button>
                        <button onclick="downloadImage()" title="Download">
                            <i class="ti ti-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    let currentZoom = 1;
    let currentRotation = 0;
    let isDragging = false;
    let startX, startY, translateX = 0, translateY = 0;
    let isFullscreen = false;
    const previewImage = document.getElementById('previewImage');
    const previewContainer = document.getElementById('previewContainer');
    const zoomLevelEl = document.getElementById('zoomLevel');
    const loadingEl = document.querySelector('.preview-loading');

    function resetImageState() {
        currentZoom = 1;
        currentRotation = 0;
        translateX = 0;
        translateY = 0;
        if (previewImage) {
            previewImage.style.cursor = 'grab';
            updateImageTransform();
        }
    }

    function updateImageTransform() {
        if (previewImage) {
            previewImage.style.transform = `translate(${translateX}px, ${translateY}px) scale(${currentZoom}) rotate(${currentRotation}deg)`;
        }
    }

    function viewImage(imageUrl) {
        resetImageState();
        loadingEl.style.display = 'block';
        previewImage.style.opacity = '0';
        
        previewImage.onload = function() {
            loadingEl.style.display = 'none';
            previewImage.style.opacity = '1';
            
            // Enable interactions
            previewImage.addEventListener('mousedown', startDrag);
            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', endDrag);
            previewContainer.addEventListener('wheel', handleWheel);
            
            // Enable touch events
            previewImage.addEventListener('touchstart', handleTouchStart);
            previewImage.addEventListener('touchmove', handleTouchMove);
            previewImage.addEventListener('touchend', handleTouchEnd);
        };
        
        previewImage.src = imageUrl;
        new bootstrap.Modal(document.getElementById('viewImageModal')).show();
    }

    function updateZoomLevel() {
        const percentage = Math.round(currentZoom * 100);
        zoomLevelEl.textContent = `${percentage}%`;
        zoomLevelEl.classList.add('visible');
        clearTimeout(zoomLevelEl.timeout);
        zoomLevelEl.timeout = setTimeout(() => {
            zoomLevelEl.classList.remove('visible');
        }, 1500);
    }

    function zoomIn() {
        currentZoom = Math.min(currentZoom * 1.2, 5);
        updateImageTransform();
        updateZoomLevel();
    }

    function zoomOut() {
        currentZoom = Math.max(currentZoom / 1.2, 0.5);
        updateImageTransform();
        updateZoomLevel();
    }

    function resetZoom() {
        resetImageState();
        updateZoomLevel();
    }

    function rotateImage() {
        currentRotation += 90;
        updateImageTransform();
    }

    function startDrag(e) {
        if (currentZoom > 1) {
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            previewImage.style.cursor = 'grabbing';
        }
    }

    function drag(e) {
        if (!isDragging) return;
        e.preventDefault();
        translateX = e.clientX - startX;
        translateY = e.clientY - startY;
        updateImageTransform();
    }

    function endDrag() {
        isDragging = false;
        previewImage.style.cursor = 'zoom-in';
    }

    function handleWheel(e) {
        e.preventDefault();
        if (e.deltaY < 0) {
            zoomIn();
        } else {
            zoomOut();
        }
    }

    function downloadImage() {
        const link = document.createElement('a');
        link.href = previewImage.src;
        link.download = 'accident-image-' + Date.now() + '.jpg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function toggleFullscreen() {
        const modal = document.getElementById('viewImageModal');
        if (!isFullscreen) {
            if (modal.requestFullscreen) {
                modal.requestFullscreen();
            } else if (modal.webkitRequestFullscreen) {
                modal.webkitRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
        isFullscreen = !isFullscreen;
    }

    // Touch events handling
    let touchStartX, touchStartY, initialDistance = 0;

    function handleTouchStart(e) {
        if (e.touches.length === 2) {
            initialDistance = getTouchDistance(e.touches);
        } else {
            touchStartX = e.touches[0].clientX - translateX;
            touchStartY = e.touches[0].clientY - translateY;
        }
    }

    function handleTouchMove(e) {
        e.preventDefault();
        if (e.touches.length === 2) {
            const currentDistance = getTouchDistance(e.touches);
            const scale = currentDistance / initialDistance;
            currentZoom = Math.min(Math.max(currentZoom * scale, 0.5), 5);
            initialDistance = currentDistance;
            updateImageTransform();
            updateZoomLevel();
        } else if (currentZoom > 1) {
            translateX = e.touches[0].clientX - touchStartX;
            translateY = e.touches[0].clientY - touchStartY;
            updateImageTransform();
        }
    }

    function getTouchDistance(touches) {
        return Math.hypot(
            touches[1].clientX - touches[0].clientX,
            touches[1].clientY - touches[0].clientY
        );
    }

    function handleTouchEnd() {
        initialDistance = 0;
    }

    // Cleanup event listeners
    document.getElementById('viewImageModal').addEventListener('hidden.bs.modal', function () {
        previewContainer.removeEventListener('wheel', handleWheel);
        previewImage.removeEventListener('mousedown', startDrag);
        document.removeEventListener('mousemove', drag);
        document.removeEventListener('mouseup', endDrag);
        previewImage.removeEventListener('touchstart', handleTouchStart);
        previewImage.removeEventListener('touchmove', handleTouchMove);
        previewImage.removeEventListener('touchend', handleTouchEnd);
    });
</script>
@endpush
