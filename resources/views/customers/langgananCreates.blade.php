@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="top-zone mt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item text-decoration-none fs-5" href="/subscribers">Langganan</a>
                <span class="breadcrumb-item fs-5 active" aria-current="page">Edit</span>
            </nav>
            {{-- <div class="breadcrumbs mt-5 mb-0">
                <h4>
                    {!! Breadcrumbs::render('subscribers.index') !!} / Show
                </h4>
            </div> --}}
            <div class="card px-5">
                <div class="card-body">
                    <form method="POST" action="/subscribers">
                        @csrf
                    
                        <div class="form-group">
                            <label class="py-1" for="selectName">Nama</label>
                            <select name="name" id="selectName" class="form-select py-1 mt-1" required oninput="getCustomerData(this.value)">
                                @foreach ($data as $row)
                                    @if (old('name') == $row->id)
                                        <option value="{{ $row->name }}" selected>{{ $row->name }}</option>
                                    @else
                                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="flowers">Flowers</label>
                            <select name="flowers_id[]" class="form-select" multiple required>
                                <!-- Populate options from flowers table -->
                                @foreach ($flowers as $flower)
                                    <option value="{{ $flower->id }}">{{ $flower->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" name="total" class="form-control" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="regencies">Regencies</label>
                            <select name="regencies_id" id="regencies_id" class="form-control" required>
                                <!-- Populate options from regencies table -->
                                @foreach ($regency as $regencies)
                                    <option value="{{ $regencies->id }}">{{ $regencies->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" class="form-control" required></textarea>
                        </div>
                    
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                    
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                    
                        <div class="form-group">
                            <label for="additional_customers">Additional Customers</label>
                            <button type="button" class="btn btn-primary" id="add-customer">Add Customer</button>
                        </div>
                    
                        <div id="additional-customers-container">
                            <!-- Additional customers will be appended here -->
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                                       

                </div>
            </div>
        </div>
        <script>
            function getCustomerData(name) {
                fetch('/get-customer-data/' + name)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('address').value = data.address;
                        document.getElementById('phone').value = data.phone;
                        document.getElementById('regencies_id').value = data.regencies_id;
                    });
            }
        </script>
         <script>
            // JavaScript to handle adding additional customers dynamically
            const addButton = document.getElementById('add-customer');
            const container = document.getElementById('additional-customers-container');
        
            let customerCount = 1;
        
            addButton.addEventListener('click', () => {
                const additionalCustomerHTML = `
                    <h3>Additional Customer ${customerCount + 1}</h3>
        
                    <div class="form-group">
                        <label for="name_${customerCount}">Name</label>
                        <input type="text" name="name[]" class="form-control" required>
                    </div>
        
                    <div class="form-group">
                        <label for="flowers_${customerCount}">Flowers</label>
                        <select name="flowers_id[]" class="form-control" multiple required>
                            <!-- Populate options from flowers table -->
                            @foreach ($flowers as $flower)
                                <option value="{{ $flower->id }}">{{ $flower->name }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="form-group">
                        <label for="total_${customerCount}">Total</label>
                        <input type="number" name="total[]" class="form-control" required>
                    </div>
                `;
        
                const customerDiv = document.createElement('div');
                customerDiv.innerHTML = additionalCustomerHTML;
        
                container.appendChild(customerDiv);
        
                customerCount++;
            });
        </script>

    @endsection
