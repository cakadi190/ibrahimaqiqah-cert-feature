<!DOCTYPE html>
<html>

<head>
    <title>Upload & Crop Image</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- CropperJS CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <style>
        .stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .step {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fff;
            border: 2px solid #dee2e6;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
        }

        .step.active .step-number {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        .step.completed .step-number {
            background-color: #198754;
            border-color: #198754;
            color: #fff;
        }

        .step-title {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .step.active .step-title {
            color: #0d6efd;
        }

        .step.completed .step-title {
            color: #198754;
        }

        .step-line {
            position: absolute;
            top: 15px;
            height: 2px;
            background-color: #dee2e6;
            width: 100%;
            left: 0;
            z-index: 0;
        }

        #cropperContainer {
            width: 100%;
            height: 60vh;
            overflow: hidden;
            background-color: #000;
        }

        #cropperImage {
            max-width: 100%;
            max-height: 100%;
            display: block;
        }

        .step-content {
            min-height: 300px;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .step-content.active {
            display: flex;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <!-- Upload Button -->
        <div class="mb-4 text-center">
            <button class="btn btn-primary" id="startUploadBtn">
                Start Upload
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="p-4 modal-body">
                        <!-- Stepper -->
                        <div class="stepper">
                            <div class="step-line"></div>
                            <div class="step active" data-step="1">
                                <div class="step-number">1</div>
                                <div class="step-title">Select File</div>
                            </div>
                            <div class="step" data-step="2">
                                <div class="step-number">2</div>
                                <div class="step-title">Crop Image</div>
                            </div>
                            <div class="step" data-step="3">
                                <div class="step-number">3</div>
                                <div class="step-title">Upload</div>
                            </div>
                        </div>

                        <!-- Step Contents -->
                        <div class="step-content active" id="step1Content">
                            <div class="text-center">
                                <input type="file" class="d-none" id="imageInput" accept="image/*">
                                <button class="btn btn-primary" onclick="document.getElementById('imageInput').click()">
                                    Choose File
                                </button>
                            </div>
                        </div>

                        <div class="step-content" id="step2Content">
                            <div id="cropperContainer">
                                <img id="cropperImage" src="">
                            </div>
                        </div>

                        <div class="step-content" id="step3Content">
                            <div class="text-center">
                                <div class="mb-3 spinner-border text-primary"></div>
                                <p>Uploading image...</p>
                            </div>
                        </div>

                        <!-- Form untuk upload -->
                        <form id="uploadForm" method="POST" enctype="multipart/form-data" style="display: none;">
                            @csrf
                            <input type="file" name="cropped_image" id="croppedImageInput">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="nextBtn" style="display: none;">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        let cropper = null;
        let currentStep = 1;
        const modal = new bootstrap.Modal(document.getElementById('uploadModal'));

        // Start upload button
        document.getElementById('startUploadBtn').addEventListener('click', () => {
            resetStepper();
            modal.show();
        });

        // File input change
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('cropperImage').src = e.target.result;
                    goToStep(2);

                    // Initialize cropper
                    setTimeout(() => {
                        if (cropper) cropper.destroy();
                        cropper = new Cropper(document.getElementById('cropperImage'), {
                            aspectRatio: 1,
                            viewMode: 1,
                            dragMode: 'move',
                            autoCropArea: 1,
                            restore: false,
                            guides: true,
                            center: true,
                            highlight: true,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                            minContainerWidth: 100,
                            minContainerHeight: 100,
                            responsive: true
                        });
                    }, 200);
                };
                reader.readAsDataURL(file);
            }
        });

        // Next button click
        document.getElementById('nextBtn').addEventListener('click', async () => {
            if (currentStep === 2) {
                await handleCrop();
            }
        });

        // Handle crop and upload
        async function handleCrop() {
            if (!cropper) return;

            const canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400
            });

            canvas.toBlob(async function(blob) {
                const fileName = 'cropped_' + Date.now() + '.jpg';
                const croppedFile = new File([blob], fileName, { type: 'image/jpeg' });

                goToStep(3);

                const formData = new FormData();
                formData.append('image', croppedFile);
                formData.append('_token', document.querySelector('input[name="_token"]').value);

                try {
                    const response = await fetch('{{ route("upload-image.store") }}', {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        console.log('Upload success');
                        setTimeout(() => {
                            modal.hide();
                            resetStepper();
                        }, 1000);
                    } else {
                        throw new Error('Upload failed');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Upload failed. Please try again.');
                    goToStep(2);
                }
            }, 'image/jpeg', 0.8);
        }

        // Go to specific step
        function goToStep(step) {
            currentStep = step;

            // Update steps
            document.querySelectorAll('.step').forEach(el => {
                const stepNum = parseInt(el.dataset.step);
                el.classList.remove('active', 'completed');
                if (stepNum === currentStep) {
                    el.classList.add('active');
                } else if (stepNum < currentStep) {
                    el.classList.add('completed');
                }
            });

            // Show/hide contents
            document.querySelectorAll('.step-content').forEach(el => {
                el.classList.remove('active');
            });
            document.getElementById(`step${step}Content`).classList.add('active');

            // Show/hide next button
            const nextBtn = document.getElementById('nextBtn');
            nextBtn.style.display = step === 2 ? 'block' : 'none';
        }

        // Reset stepper
        function resetStepper() {
            currentStep = 1;
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            document.getElementById('imageInput').value = '';
            document.getElementById('cropperImage').src = '';
            goToStep(1);
        }

        // Handle modal close
        document.getElementById('uploadModal').addEventListener('hidden.bs.modal', function () {
            resetStepper();
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (cropper) {
                cropper.resize();
            }
        });
    </script>
</body>

</html>
