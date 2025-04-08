@extends('layouts.Frontend.mainlayoutfrontend')
@section('title')مصممي اوبوليا @endsection
@section('content')

<div class="container p-4" >
<div class="row row-cols-1 row-cols-md-3 g-4 m-3">

@foreach($designer as $designer)
<div class="col">
            <div class="designer-card p-4"
                 data-bs-toggle="modal"
                 data-bs-target="#designerModal"
                 data-name="{{ $designer->user->name }}"
                 data-image="{{ asset($designer->profile_image ? 'storage/' . $designer->profile_image : 'storage/profile_images/ProfilePlaceholder.jpg') }}"
                 data-bio="{{ $designer->description_ar }}"
                 data-experience="{{ $designer->experience_years }}"
                 data-rating="{{ $designer->rating }}"
                 data-portfolio="{{ $designer->portfolio_images }}">
                <img src="{{asset($designer->profile_image ? 'storage/' . $designer->profile_image : 'storage/profile_images/ProfilePlaceholder.jpg') }}" class="img-fluid rounded-4" alt="Designer Profile Picture">
                <div class="designer-info mt-3">
                    <h5>{{ $designer->user->name }}</h5>
                </div>
            </div>
</div>
        @endforeach
    </div>
</div>

<!-- Designer Info Modal -->
<div class="modal fade" id="designerModal" tabindex="-1" aria-labelledby="designerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="align-items: center;">
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close" style="padding: 15px;"></button>

            <div class="modal-header">
                <h5 class="modal-title" id="designerName"></h5>
            </div>
            <div class="modal-body text-center">
                <img id="designerImage" src="" class="img-fluid rounded mb-3" style="max-width: 200px;">
                <p id="designerBio" class="mt-2"></p>

                <!-- Portfolio Images -->

                <!-- Portfolio Images Carousel -->
                <div id="portfolioContainerWrapper">
                    <div id="portfolioContainer" class="owl-carousel owl-theme p-3" style="text-align: -webkit-center"></div>
                </div>

                <p><strong>الخبرة:</strong> <span id="designerExperience"></span> سنوات</p>
                <p><strong>التقييم:</strong> ⭐ <span id="designerRating"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Image Full View Modal -->
<div class="modal fade" id="portfolioModal" tabindex="-1" aria-labelledby="portfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">عرض الصورة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="portfolioImage" src="" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>


<script>
   document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".designer-card").forEach(card => {
        card.addEventListener("click", function () {
            // Get designer data attributes
            let name = this.getAttribute("data-name") || "غير معروف";
            let image = this.getAttribute("data-image") || "/ProfilePlaceholder.jpg";
            let bio = this.getAttribute("data-bio") || "لا يوجد وصف متاح";
            let experience = this.getAttribute("data-experience") || "غير معروف";
            let rating = this.getAttribute("data-rating") || "غير متاح";
            let portfolioJson = this.getAttribute("data-portfolio");

            console.log("Clicked Designer:", { name, image, bio, experience, rating, portfolioJson });

            // Update designer modal with data
            document.getElementById("designerName").innerText = name;
            document.getElementById("designerImage").src = image;
            document.getElementById("designerBio").innerText = bio;
            document.getElementById("designerExperience").innerText = experience;
            document.getElementById("designerRating").innerText = rating;

            // Handle portfolio images dynamically
            let portfolioContainer = $("#portfolioContainer");

            // **Destroy Owl Carousel if already initialized**
            if (portfolioContainer.hasClass("owl-loaded")) {
                portfolioContainer.trigger("destroy.owl.carousel").removeClass("owl-loaded");
            }

            portfolioContainer.empty(); // Clear old images

            if (portfolioJson) {
                let portfolioImages = [];
                try {
                    portfolioImages = JSON.parse(portfolioJson);
                } catch (error) {
                    console.error("Error parsing portfolio JSON:", error);
                    return;
                }

                // Append new images to the carousel
                portfolioImages.forEach(imagePath => {
                    let itemDiv = `<div class="item">
                        <img src="/storage/${imagePath}" class="img-fluid rounded" style="width: 150px; cursor: pointer;" onclick="showPortfolioImage('/storage/${imagePath}')">
                    </div>`;
                    portfolioContainer.append($(itemDiv));
                });

                // **Reinitialize Owl Carousel**
                portfolioContainer.owlCarousel({
                    loop: false,
                    margin: 10,
                    nav: true,
                    dots: false,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 2 },
                        1000: { items: 3 }
                    }
                });
            }

            // Open the designer modal
            $("#designerModal").modal("show");
        });
    });
});

// Function to show the full image in the portfolio modal
function showPortfolioImage(imageSrc) {
    $("#portfolioImage").attr("src", imageSrc);
    $("#portfolioModal").modal("show");
}
</script>

@endsection
