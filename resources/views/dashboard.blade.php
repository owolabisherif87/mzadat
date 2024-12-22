@extends('layouts.app')
@section('page')
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold mb-10">Welcome {{ Auth::user()->name }}</h3>
                        <div id="loader" class="">Loading.....</div>
                        <h3 id="empty" class="hidden">Your shopping list is empty.</h3>
                        <div id="shoppingList" class="hidden">
                            <h3 class="font-bold text-xl mb-10">Your shopping list</h3>
                            <table class="table-fixed w-full mb-5">
                                <thead>
                                    <tr class="text-left">
                                        <th>S/N</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Unit price</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="shoppingListBody"></tbody>
                            </table>
                            <div class="w-full  justify-end mb-10 text-2xl hidden" id="totalMain">
                                <h3 class="mr-3">Gross total:</h3>
                                <h3 id="total">0</h3>
                            </div>
                        </div>
                        <div class="flex justify-end">

                            <x-primary-button class="mr-3" id="addItem">
                                {{ __('Add new item') }}
                            </x-primary-button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <x-modal>
        @section('modal-header')
            <h1>Add new shopping item</h1>
        @endsection
        @section('modal-body')
            <form accept="" method="POST">
                @csrf
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" class="text-black" />

                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required
                        autocomplete="name" />

                    <div class="mt-2 text-red-500" id="nameError">{{ $errors->has('name') }}</div>
                </div>
                <div class="mt-4">
                    <x-input-label for="quantity" :value="__('Quantity')" class="text-black" />

                    <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" required
                        autocomplete="quantity" />

                    <div class="mt-2 text-red-500" id="quantityError">{{ $errors->has('quantity') }}</div>
                </div>
                <div class="mt-4">
                    <x-input-label for="unitprice" :value="__('Unit price')" class="text-black" />

                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="unitprice" required
                        autocomplete="unitprice" />

                    <div class="mt-2 text-red-500" id="priceError">{{ $errors->has('unitprice') }}</div>
                </div>
            </form>
        @endsection
        @section('modal-footer')
            <div class="flex">
                <x-primary-button class="mr-3" id="modalSubmit">
                    {{ __('Submit') }}
                </x-primary-button>
                <x-primary-button class=" bg-gray-500" id="modalClose">
                    {{ __('Close') }}
                </x-primary-button>
            </div>
        @endsection
    </x-modal>

</div>


<script>
    let modal = document.getElementById("modal")
    let modalSubmit = document.getElementById("modalSubmit")
    let modalClose = document.getElementById("modalClose")
    let addItem = document.getElementById("addItem")
    let shoppingListBody = document.getElementById("shoppingListBody")
    let shoppingList = document.getElementById("shoppingList")
    let totalMain = document.getElementById("totalMain")
    let totalCost = document.getElementById("total")
    let loader = document.getElementById("loader")
    let empty = document.getElementById("empty")

    modalClose.addEventListener("click", () => {
        modal.classList.add('hidden')
    })

    addItem.addEventListener("click", () => {
        modal.classList.remove('hidden')
    })

    modalSubmit.addEventListener("click", () => {
        postItem()
    })

    document.onload = loadList()

    function postItem() {
        let errors = [];
        let name = document.getElementById("name").value
        let nameError = document.getElementById("nameError")
        let quantity = document.getElementById("quantity").value
        let quantityError = document.getElementById("quantityError")
        let price = document.getElementById("price").value;
        let priceError = document.getElementById("priceError");

        if (name == "") {
            errors.push("Name required")
            nameError.innerText = "Name required"
        }
        if (quantity == "") {
            errors.push("Quantity required")
            quantityError.innerText = "Quantity required"
        }
        if (price == "") {
            priceError.innerText = "Price required"
            errors.push("Price required")
        }

        if (errors.length) {

            return
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            let response = JSON.parse(this.responseText)
            if (this.status == 200) {
                modal.classList.add('hidden')
                loadList()
            } else {

                alert(response.message)
            }
        };
        xhttp.open("POST", "/product/store", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute(
            'content'));
        xhttp.send(`name=${name}&quantity=${quantity}&price=${price}`);
    }

    function loadList() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            empty.classList.add('hidden')
            shoppingListBody.innerHTML = ""
            const products = JSON.parse(this.responseText)
            let td = document.createElement("td")
            var total = 0


            for (let index = 0; index < products.length; index++) {
                let tr = document.createElement("tr")
                let item = products[index]

                var unitPrice = item.price * item.quantity;
                total += unitPrice
                tr.innerHTML =
                    `<td>${index + 1}</td><td>${item.name}</td><td>${item.quantity}</td><td>${item.price}</td><td>${unitPrice}</td>`
                shoppingListBody.append(tr)
            }

            if (products.length) {
                shoppingList.classList.remove('hidden')
                loader.classList.add('hidden')
                totalMain.classList.remove('hidden')
                totalMain.classList.add('flex')
            } else {

                loader.classList.add('hidden')
                empty.classList.remove('hidden')
            }

            totalCost.innerHTML = total
        }
        xhttp.open("GET", "/product/show");
        xhttp.send();
    }
</script>
@endsection
