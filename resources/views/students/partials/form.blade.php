<div class="card app-card mx-auto" style="max-width: 800px">
    <div class="card-body p-4 p-md-5">
        @if($errors->any())<div class="alert alert-danger"><strong>Please fix the following:</strong>
            <ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>@endif
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">@csrf @if($student) @method('PUT') @endif

            <div class="row g-3">
                <div class="col-md-8"><label class="form-label" for="name">Name</label><input class="form-control" id="name" name="name" value="{{ old('name', $student?->name) }}" required></div>
<div class="col-md-4">
    <label class="form-label" for="age">Age</label>
    <input 
        class="form-control" 
        id="age" 
        name="age" 
        type="text" 
        value="{{ old('age', $student?->age) }}" 
        maxlength="3" 
        pattern="[0-9]{1,3}" 
        inputmode="numeric" 
        required 
        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);"
    >
</div>                <div class="col-md-6"><label class="form-label" for="cnic">CNIC</label><input class="form-control @error('cnic') is-invalid @enderror" id="cnic" name="cnic" value="{{ old('cnic', $student?->cnic) }}" maxlength="13" inputmode="numeric" pattern="[0-9]*" autocomplete="off" aria-describedby="cnic-feedback" required>
                    <div id="cnic-feedback" class="invalid-feedback">@error('cnic') {{ $message }} @enderror</div>
                </div>
                <div class="col-md-6">
    <label class="form-label" for="phone">Phone</label>
    <input 
        type="text"
        class="form-control @error('phone') is-invalid @enderror" 
        id="phone" 
        name="phone" 
        value="{{ old('phone', $student?->phone) }}" 
        minlength="11"
        maxlength="11" 
        pattern="[0-9]{11}" 
        inputmode="numeric" 
        autocomplete="tel" 
        aria-describedby="phone-feedback" 
        required 
        title="Phone number must contain exactly 11 digits."
        oninvalid="this.setCustomValidity('Phone number must contain exactly 11 digits.')"
        oninput="this.setCustomValidity('')"
    >
    <div id="phone-feedback" class="invalid-feedback">
        @error('phone') {{ $message }} @enderror
    </div>
                </div>
                <div class="col-12"><label class="form-label" for="email">Email address <span class="text-secondary"></span></label><input class="form-control" id="email" name="email" type="email"   required  value="{{ old('email', $student?->email) }}"></div>
                <div class="col-12"><label class="form-label" for="address">Address <span class="text-secondary">(optional)</span></label><textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $student?->address) }}</textarea></div>
                <div class="col-md-6">
                    <label class="form-label" for="department_id">Department <span class="text-secondary">(optional)</span></label>
                    <select class="form-select" id="department_id" name="department_id">
                        <option value="">No department assigned</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @selected((string) old('department_id', $student?->department_id) === (string) $department->id)>{{ $department->name }} ({{ $department->code }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6"><label class="form-label" for="profile_picture">Profile picture</label><input class="form-control" id="profile_picture" name="profile_picture" type="file" accept=".jpg,.jpeg,.png">@if($student?->profile_picture)<div class="current-file"><img class="rounded" src="{{ route('students.profile-picture', $student) }}" width="100" alt="Current profile picture">
                        <div class="small text-secondary mt-2">Upload a new photo to replace it.</div>
                    </div>@endif</div>
                <div class="col-md-6"><label class="form-label" for="pdf_file">PDF document</label><input class="form-control" id="pdf_file" name="pdf_file" type="file" accept=".pdf">@if($student?->pdf_file)<div class="current-file"><a href="{{ route('students.document', $student) }}">Download current PDF</a>
                        <div class="small text-secondary mt-2">Upload a new document to replace it.</div>
                    </div>@endif</div>
            </div>
            <button class="btn btn-primary mt-4" type="submit">{{ $submitLabel }}</button>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('#cnic, #phone').forEach((field) => {
        const feedback = document.getElementById(`${field.id}-feedback`);

        field.addEventListener('input', () => {
            const numbersOnly = field.value.replace(/\D/g, '');
            const hadInvalidCharacters = numbersOnly !== field.value;

            field.value = numbersOnly;
            field.classList.toggle('is-invalid', hadInvalidCharacters);
            feedback.textContent = hadInvalidCharacters ? 'Only numbers are valid in this field.' : '';
        });
    });
</script>
