@extends('layouts.app')

@section('content')

    <!-- عرض رسالة النجاح -->
    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- عرض رسالة الخطأ -->
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <!-- عرض رسائل التحقق من الأخطاء لكل حقل -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">
        <h1>Join as a Designer</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('joinasdesigner.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
        @csrf

        <!-- حقل الاسم -->
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>



            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email_address" class="form-label">Email Address:</label>
                <input type="email" name="email_address" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number:</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" name="age" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality:</label>
                <input type="text" name="nationality" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" class="form-control" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="marital_status" class="form-label">Marital Status:</label>
                <select name="marital_status" class="form-control" required>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="other">Other</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="region_id" class="form-label">Region:</label>
                <select name="region_id" id="region_id" class="form-control" required>
                    <option value="" disabled selected>Select Region</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name_en }}</option> <!-- فقط تمرير المعرف -->
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <label for="major_in_education" class="form-label">Major in Education:</label>
                <input type="text" name="major_in_education" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="years_of_experience" class="form-label">Years of Experience:</label>
                <input type="number" name="years_of_experience" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="experience_in_sales" class="form-label">Do you have experience in Sales?</label>
                <select name="experience_in_sales" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="current_occupation" class="form-label">What's your current occupation?</label>
                <select name="current_occupation" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="willing_to_work_as_freelancer" class="form-label">Are you willing to work as a freelancer?</label>
                <select name="willing_to_work_as_freelancer" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="own_car" class="form-label">Do you own a car?</label>
                <select name="own_car" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="experience_in_kitchen_furniture_business" class="form-label">Do you have experience in the kitchen furniture business?</label>
                <select name="experience_in_kitchen_furniture_business" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="kitchen_furniture_experience_description" class="form-label">If yes, please explain:</label>
                <textarea name="kitchen_furniture_experience_description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="cv_pdf" class="form-label">Upload Your CV (PDF):</label>
                <input type="file" name="cv_pdf" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
