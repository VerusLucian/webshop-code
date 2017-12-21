@extends('layouts/adminMaster') @section('title') Add Products @endsection @section('content')
    <div class="container addSizer">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        <div class="page-header">
            <h2>Add products</h2>
        </div>
        <div class="container d-inline">
            <div class="row">
                <div class="col">

                    <div class="form">
                        <form class="form-inline" action="{{action('ProductController@store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col">
                                <div class="form-group form-padding">
                                    <label for="name" class="col-2">Naam</label>
                                    <input class="form-control col" type="text" id="name" name="name" required>
                                </div>
                                <div class="form-group form-padding">
                                    <label for="category" class="col-2">Categorie</label>
                                    <select class="form-control col" name="category" id="category">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-padding">
                                    <label for="price" class="col-2">Prijs</label>
                                    <input class="form-control col" type="text" name="price" id="price" required>
                                </div>
                                <div class="form-group form-padding">
                                    <label for="house" class="col-2">House</label>
                                    <select class="form-control col" name="house" id="house">
                                        @foreach($houses as $house)
                                            <option value="{{$house->id}}">{{$house->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-padding">
                                    <label for="stock" class="col-2">Voorraad</label>
                                    <input class="form-control col" type="text" name="stock" id="stock" required>
                                </div>
                            </div>
                            <div class="col sizes">
                                <h5>Maten</h5>
                                <div class="form-group flex flex-between">
                                    <label for="sizeS">S</label>
                                    <input class="form-control" type="checkbox" id="sizeS" name="sizeS">
                                </div>
                                <div class="form-group flex flex-between">
                                    <label for="sizeM">M</label>
                                    <input class="form-control" type="checkbox" id="sizeM" name="sizeM">
                                </div>
                                <div class="form-group flex flex-between">
                                    <label for="sizeL">L</label>
                                    <input class="form-control" type="checkbox" id="sizeL" name="sizeL">
                                </div>
                                <div class="form-group flex flex-between">
                                    <label for="sizeXL">XL</label>
                                    <input class="form-control" type="checkbox" id="sizeXL" name="sizeXL">
                                </div>
                                <div class="form-group">
                                    <label for="sizeGB">Storage</label>
                                    <select class="form-control" name="sizeGB" id="sizeGB">
                                        @foreach($storages as $storage)
                                            <option class="form-control" value="{{$storage->id}}">{{$storage->gb}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="form-group textSizerForm">
                        <label for="description">Beschrijving</label>
                        <textarea class="form-control" name="description" id="description" cols="45" rows="5"
                                  required></textarea>
                    </div>
                    <div class="w-100"></div>
                    <div class="form-group  -between upload">
                        <label for="image">Upload Foto</label>
                        <input class="form-control" type="file" name="image[]" id="image" multiple required>
                    </div>
                    <input class="btn btn-default" type="submit" value="Save" class="save">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection