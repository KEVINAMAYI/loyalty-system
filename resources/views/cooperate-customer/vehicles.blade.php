@extends('cooperate-customer.layout.body')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h6 class="font-weight-bolder mb-0">Vehicles</h6>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">

            {{-- display success message on a successful action --}}
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
            </div>
            @endif

            {{-- display error on top of the form --}}
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="list-group">
                    @foreach ($errors->all() as $error )
                    <li class="list-group-item">
                    {{ $error }}  
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

        <button type="button" style="background-color:#f9a14d;" class="btn btn-success btn-md" data-bs-toggle="modal"
            data-bs-target="#vehicles"><i class="fa-solid fa-plus"></i>
            <span style="margin-left:5px;">Add Vehicle</span></button>


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Vehicles</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="vehicles_table" class="table  align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th style="border-bottom:1px solid" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Category</th>
                                            <th
                                            style="border-bottom:1px solid" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Vehicle Model</th>
                                            <th
                                            style="border-bottom:1px solid" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Registration</th>
                                             <th
                                                style="border-bottom:1px solid" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Vehicle Fuel Type</th>
                                            <th
                                            style="border-bottom:1px solid" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="align-items-center">

                                        @foreach( $vehicles as $vehicle)

                                            <tr>
                                                <td style="padding-left:20px;" class="align-middle text-left text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ strtoupper($vehicle->vehicle_category) }}</p>
                                                </td>
                                                <td class="align-middle text-left text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ strtoupper($vehicle->vehicle_type) }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-secondary text-xs font-weight-bold">{{ strtoupper($vehicle->vehicle_registration) }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                  <span class="text-secondary text-xs font-weight-bold">{{ strtoupper($vehicle->fuel_type) }}</span>
                                              </td>
                                                <td class="align-middle text-center text-sm">
                                                    <a href="" class="showeditvehiclemodal"  id="{{ $vehicle->id }}">
                                                     <span style="background-color:#3875b6;"
                                                            class="badge badge-sm">edit</span></a>
                                                    <a href="/delete-coorporate-vehicle/{{ $vehicle->id }}" class="badge badge-sm bg-gradient-danger">delete</a>
                                                </td>
                                            </tr>   

                                        @endforeach
                                    <tfoot>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Category</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Vehicle Model</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Vehicle Registration</th>
                                                <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Fuel Type</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>

                                        </tr>
                                    </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- vehicle modal -->
<!-- Modal -->
<form action="/add-coorporate-vehicle" method="post">
    @csrf
    <div class="modal fade" id="vehicles" tabindex="-1" aria-labelledby="vehicles" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Vehicle</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-holder form-holder-2">
              <label for="vehicle_category">Vehicle Category</label>
              <select name="vehicle_category" id="vehicle_category" class="form-control">
                <option value="none">Choose...</option>
                <option value="sedan">Sedan</option>
                <option value="coupe">Coupe</option>
                <option value="hatchback">Hatchback</option>
                <option value="station-wagon">Station Wagon</option>
                <option value="suv">SUV</option>
                <option value="pick-up">Pick up</option>
                <option value="van">Van</option>
                <option value="mini-van">Mini Van</option>
                <option value="wagon">Wagon</option>
                <option value="convertible">Convertible</option>
                <option value="bus">Bus</option>
                <option value="truck">Truck</option>
            </select>
            </div>
    
            <div class="form-holder form-holder-2">
              <label for="vehicle_type">Vehicle Type</label>
              <select name="vehicle_type" id="vehicle_type" class="form-control">
                <option value="none">Choose...</option>
                <option value="audi">Audi</option>
                <option value="bmw">BMW</option>
                <option value="chevrolet">Chevrolet</option>
                <option value="chrysler">Chrysler</option>
                <option value="citroen">Citroën</option>
                <option value="daihatsu">Daihatsu</option>
                <option value="eicher">EICHER</option>
                <option value="ford">Ford</option>
                <option value="hino">HINO</option>
                <option value="honda">Honda</option>
                <option value="hyundai">Hyundai</option>
                <option value="jaguar">Jaguar</option>
                <option value="jeep">Jeep</option>
                <option value="kia">Kia</option>
                <option value="land rover">Land Rover</option>
                <option value="lexus">Lexus</option>
                <option value="man">Man</option>
                <option value="maserati">Maserati</option>
                <option value="mazda">Mazda</option>
                <option value="mercedes-benz">Mercedes-Benz</option>
                <option value="mini">MINI</option>
                <option value="mitsubishi">Mitsubishi</option>
                <option value="mobius">MOBIUS</option>
                <option value="nissan">Nissan</option>
                <option value="peugout">Peugeot</option>
                <option value="porsche">Porsche</option>
                <option value="range rover">Range Rover</option>
                <option value="subaru">Subaru</option>
                <option value="suzuki">Suzuki</option>
                <option value="toyota">Toyota</option>
                <option value="volkswagen">Volkswagen</option>
                <option value="volvo">Volvo</option>
    
            </select>
            </div>
            <div  class="form-holder form-holder-2">
              <label for="fuel_type" style="font-weight:bold;">Vehicle Fuel Type</label>
              <select name="fuel_type" id="fuel_type" class="form-control">
                      <option value="Diesel">Diesel</option>
                      <option value="Petrol">Petrol</option>
              </select> 
          </div>    
            <div class="form-holder form-holder-2 mb-4">
              <label for="regno">Vehicle Registration</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="vehicle_registration" id="vehicle_registration" placeholder="" required>
            </div>
    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Add Vehicle</button>
          </div>
        </div>
      </div>
    </div>
    </form>

<!-- edit vehicle modal -->
<!-- Modal -->
<form action="/edit-coorporate-vehicle" method="post">
@csrf
<div class="modal fade" id="vehiclesedit" tabindex="-1" aria-labelledby="vehiclesedit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Vehicle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-holder form-holder-2">
          <label for="card-type">Vehicle Category</label>
          <select name="edit_vehicle_category" id="edit_vehicle_category" class="form-control">
            <option value="sedan">Sedan</option>
            <option value="coupe">Coupe</option>
            <option value="hatchback">Hatchback</option>
            <option value="station-wagon">Station Wagon</option>
            <option value="suv">SUV</option>
            <option value="pick-up">Pick up</option>
            <option value="van">Van</option>
            <option value="mini-van">Mini Van</option>
            <option value="wagon">Wagon</option>
            <option value="convertible">Convertible</option>
            <option value="bus">Bus</option>
            <option value="truck">Truck</option>
        </select>
        </div>

        <div class="form-holder form-holder-2">
          <label for="card-type">Vehicle Type</label>
          <select name="edit_vehicle_type" id="edit_vehicle_type" class="form-control">
                <option value="audi">Audi</option>
                <option value="bmw">BMW</option>
                <option value="chevrolet">Chevrolet</option>
                <option value="chrysler">Chrysler</option>
                <option value="citroen">Citroën</option>
                <option value="daihatsu">Daihatsu</option>
                <option value="eicher">EICHER</option>
                <option value="ford">Ford</option>
                <option value="hino">HINO</option>
                <option value="honda">Honda</option>
                <option value="hyundai">Hyundai</option>
                <option value="jaguar">Jaguar</option>
                <option value="jeep">Jeep</option>
                <option value="kia">Kia</option>
                <option value="land rover">Land Rover</option>
                <option value="lexus">Lexus</option>
                <option value="man">Man</option>
                <option value="maserati">Maserati</option>
                <option value="mazda">Mazda</option>
                <option value="mercedes-benz">Mercedes-Benz</option>
                <option value="mini">MINI</option>
                <option value="mitsubishi">Mitsubishi</option>
                <option value="mobius">MOBIUS</option>
                <option value="nissan">Nissan</option>
                <option value="peugout">Peugeot</option>
                <option value="porsche">Porsche</option>
                <option value="range rover">Range Rover</option>
                <option value="subaru">Subaru</option>
                <option value="suzuki">Suzuki</option>
                <option value="toyota">Toyota</option>
                <option value="volkswagen">Volkswagen</option>
                <option value="volvo">Volvo</option>
        </select>
        </div>
        <div style="" class="form-holder form-holder-2">
          <label for="fuel_type" style="font-weight:bold;">Vehicle Fuel Type</label>
          <select name="edit_fuel_type" id="edit_fuel_type" class="form-control">
                  <option value="Diesel">Diesel</option>
                  <option value="Petrol">Petrol</option>
          </select> 
      </div>
        <div class="form-holder form-holder-2 mb-4">
          <label for="regno">Vehicle Registration</label></br>
          <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="text" name="edit_vehicle_registration" id="edit_vehicle_registration" placeholder="KAG 445" required>
        </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="vehicle_edit_id" id="vehicle_edit_id">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Edit Vehicle</button>
      </div>
    </div>
  </div>
</div>
</form>

@endsection
