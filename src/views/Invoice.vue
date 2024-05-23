<script setup>
import { ref } from 'vue';


document.addEventListener('DOMContentLoaded', function () {
    const printButton = document.getElementById('printButton');

    printButton.addEventListener('click', function () {
        printRecipe();
    });

    function printRecipe() {
        window.print();
    }
});

// Reactive variables
const customer = ref('cust1');
const invoiceDate = ref('');
const dueDate = ref('');
const numero = ref('');
const reference = ref('');
const items = ref([
  { description: '#093654 vjxhchkvhxc vkxckvjkxc jkvjxckvjkx', unitPrice: 10000, quantity: 1 }
]);
const termsAndConditions = ref('');
const discount = ref('');
const selectedItem = ref('None');
const showModal = ref(false);

// Toggle modal function
const toggleModal = () => {
  showModal.value = !showModal.value;
};

// Save item function
const saveItem = () => {
  // Logic to save the item
  console.log('Item saved!');
  closeModal(); // Assuming closeModal is defined
};

// Close modal function
const closeModal = () => {
  showModal.value = false;
};

// Methods for calculating subtotal and grand total
const calculateSubTotal = () => {
  let subtotal = 0;
  for (const item of items.value) {
    subtotal += item.unitPrice * item.quantity;
  }
  return subtotal;
};

const calculateGrandTotal = () => {
  const subtotal = calculateSubTotal();
  const discountValue = parseFloat(discount.value) || 0;
  return subtotal - discountValue;
};

// Save invoice function
const saveInvoice = () => {
  // Logic to save the invoice
  console.log('Invoice saved!');
};
</script>

<style scoped>
/* Scoped styles for this component */
.invoice__title {
  margin-bottom: 20px;
}
.table--items--transactionId {
  text-decoration: none;
  color: #007bff;
}
.table--search {
  display: flex;
  align-items: center;
}
.relative {
  position: relative;
}
.table--search--input--icon {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 10px;
}
.table--search--input {
  padding-left: 30px;
}
.invoice__title {
  margin-bottom: 20px;
}
.main__modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal__content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  width: 400px;
}

.modal__close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}
.modal__title {
  margin-bottom: 10px;
}

.modal__footer {
  margin-top: 20px;
  display: flex;
  justify-content: flex-end;
}
.card__header-list {
  list-style-type: none;
  padding-left: 0;
}

.card__header-list li {
  display: inline-block;
  margin-right: 10px;
}
.card__header-list {
  list-style-type: none;
  padding-left: 0;
}
.modal {
  display: block;
  position: fixed;
  z-index: 999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal__content {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px;
}

.modal__close {
  float: right;
  cursor: pointer;
  font-size: 24px;
  font-weight: bold;
}

.modal__title {
  margin-top: 0;
}

.modal__items {
  margin-bottom: 20px;
}

.modal__footer {
  text-align: right;
}
</style>
<template>
<div class="container">
    
    <!--==================== INVOICE LIST ====================-->
    <div class="invoices ">
    <div class="card mb-3 ">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="invoice__title">Invoices</h2>
        <a href="#" class="btn btn-secondary">New Invoice</a>
      </div>
      <div class="card-body">
        <div class="table--filter d-flex justify-content-between align-items-center mb-3">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="tableFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              All
            </button>
            <ul class="dropdown-menu" aria-labelledby="tableFilterDropdown">
              <li><a class="dropdown-item active" href="#">All</a></li>
              <li><a class="dropdown-item" href="#">Paid</a></li>
            </ul>
          </div>
          <div class="table--search">
            <select class="form-select" name="" id="">
              <option value="">Filter</option>
            </select>
            <div class="relative">
              <i class="fas fa-search table--search--input--icon"></i>
              <input class="form-control table--search--input" type="text" placeholder="Search invoice">
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Number</th>
                <th scope="col">Customer</th>
                <th scope="col">Due Date</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              <!-- item 1 -->
              <tr>
                <td><a href="#" class="table--items--transactionId">#093654</a></td>
                <td>Jan 18, 9:31am</td>
                <td>#093654</td>
                <td>Jonathan Yu</td>
                <td>Jan 18, 9:31am</td>
                <td>$16,943</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

   <div class="invoices">
    <div class="card mb-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="invoice__title">New Invoice</h2>
      </div>
      <div class="card-body">
        <div class="card__content--header">
          <div>
            <label for="customer" class="form-label my-1">Customer</label>
            <select id="customer" class="form-select">
              <option value="">cust 1</option>
            </select>
          </div>
          <div>
            <label for="date" class="form-label my-1">Date</label>
            <input id="date" type="date" class="form-control">
            <label for="due_date" class="form-label my-1">Due Date</label>
            <input id="due_date" type="date" class="form-control">
          </div>
          <div>
            <label for="numero" class="form-label my-1">Numero</label>
            <input id="numero" type="text" class="form-control">
            <label for="reference" class="form-label my-1">Reference (Optional)</label>
            <input id="reference" type="text" class="form-control">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Item Description</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>#093654 </td>
                <td><input type="text" class="form-control"></td>
                <td><input type="text" class="form-control"></td>
                <td>$ 10000</td>
                <td style="color: red; font-size: 24px; cursor: pointer;">&times;</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-end align-items-center mt-3">
          <button class="btn btn-sm btn-primary me-2">Add New Line</button>
        </div>
        <div class="table__footer mt-3">
          <div class="document-footer">
            <label for="terms" class="form-label">Terms and Conditions</label>
            <textarea id="terms" class="form-control" rows="7"></textarea>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <div class="table__footer--subtotal">
              <p>Sub Total</p>
              <span>$ 1000</span>
            </div>
            <div class="table__footer--discount">
              <label for="discount" class="form-label">Discount</label>
              <input id="discount" type="text" class="form-control">
            </div>
            <div class="table__footer--total">
              <p>Grand Total</p>
              <span>$ 1200</span>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-end align-items-center mt-3">
          <button class="btn btn-secondary">Save</button>
        </div>
      </div>
    </div>
  </div>
   <!--==================== add modal items ====================-->
    <div class="modal main__modal" v-if="showModal">
    <div class="modal__content">
      <span class="modal__close btn__close--modal" @click="closeModal">×</span>
      <h3 class="modal__title">Add Item</h3>
      <hr /><br />
      <div class="modal__items">
        <select class="form-select my-1">
          <option value="None">None</option>
          <option value="LBC Padala">LBC Padala</option>
        </select>
      </div>
      <br /><hr />
      <div class="modal__footer">
        <button class="btn btn-light me-2 btn__close--modal" @click="closeModal">Cancel</button>
        <button class="btn btn-light btn__close--modal" @click="saveItem">Save</button>
      </div>
    </div>
  </div>
    
    <br><br><br>
    <!--==================== SHOW INVOICE ====================-->
    <div class="invoices">
    <div class="card__header">
      <div>
        <h2 class="invoice__title">Invoice</h2>
      </div>
      <div></div>
    </div>
    <div>
      <div class="card__header--title">
        <h1 class="mr-2">#1043</h1>
        <p>July 17, 2020 at 3:28 am</p>
      </div>
      <div>
        <ul class="card__header-list">
          <li>
            <button class="btn btn-primary" @click="printInvoice">
              <i class="fas fa-print"></i> Print
            </button>
          </li>
          <li>
            <button class="btn btn-success" @click="editInvoice">
              <i class="fas fa-edit"></i> Edit
            </button>
          </li>
          <li>
            <button class="btn btn-danger" @click="deleteInvoice">
              <i class="fas fa-trash"></i> Delete
            </button>
          </li>
        </ul>
      </div>
    </div>

    <div class="table invoice">
      <div class="logo"><!-- <img src="assets/img/logo.png" alt="" style="width: 200px;"> --></div>
      <div class="invoice__header--title">
        <p></p>
        <p class="invoice__header--title-1">Invoice</p>
        <p></p>
      </div>

      <div class="invoice__header--item">
        <div>
          <h2>Invoice To:</h2>
          <p>Customer 1</p>
        </div>
        <div>
          <div class="invoice__header--item1">
            <p>Invoice#</p>
            <span>#1200</span>
          </div>
          <div class="invoice__header--item2">
            <p>Date</p>
            <span>12/12/2022</span>
          </div>
          <div class="invoice__header--item2">
            <p>Due Date</p>
            <span>12/12/2022</span>
          </div>
          <div class="invoice__header--item2">
            <p>Reference</p>
            <span>1045</span>
          </div>
        </div>
      </div>

      <div class="table py-1">
        <div class="table--heading3">
          <p>#</p>
          <p>Item Description</p>
          <p>Unit Price</p>
          <p>Qty</p>
          <p>Total</p>
        </div>
        <!-- item 1 -->
        <div v-for="(item, index) in items" :key="index" class="table--items3">
          <p>{{ index + 1 }}</p>
          <p>Lorem Ipsum is simply dummy text</p>
          <p>$ 300</p>
          <p>1</p>
          <p>$ 300</p>
        </div>
      </div>

      <div class="invoice__subtotal">
        <div>
          <h2>Thank you for your business</h2>
        </div>
        <div>
          <div class="invoice__subtotal--item1">
            <p>Sub Total</p>
            <span>$ 1200</span>
          </div>
          <div class="invoice__subtotal--item2">
            <p>Discount</p>
            <span>$ 100</span>
          </div>
        </div>
      </div>

      <div class="invoice__total">
        <div>
          <h2>Terms and Conditions</h2>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
        <div>
          <div class="grand__total">
            <div class="grand__total--items">
              <p>Grand Total</p>
              <span>$ 1100</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card__footer">
      <div></div>
      <div>
        <button class="btn btn-secondary" @click="saveInvoice">Save</button>
      </div>
    </div>
  </div>
  <div class="invoices">
    <!-- Card Header -->
    <div class="card__header">
      <div>
        <h2 class="invoice__title">Edit Invoice</h2>
      </div>
      <div></div>
    </div>

    <!-- Card Content -->
    <div class="card__content">
      <!-- Card Content Header -->
      <div class="card__content--header">
        <!-- Customer Section -->
        <div>
          <p class="my-1">Customer</p>
          <select v-model="customer" class="form-select">
            <option >Customer 1</option>
            <option >Customer 2</option>
          </select>
        </div>
        <!-- Date and Due Date Section -->
        <div>
          <p class="my-1">Date</p>
          <input v-model="invoiceDate" type="date" class="form-control">
          <p class="my-1">Due Date</p>
          <input v-model="dueDate" type="date" class="form-control">
        </div>
        <!-- Numero and Reference Section -->
        <div>
          <p class="my-1">Numero</p>
          <input v-model="numero" type="text" class="form-control">
          <p class="my-1">Reference (Optional)</p>
          <input v-model="reference" type="text" class="form-control">
        </div>
      </div>

      <br><br>

      <!-- Table Section -->
      <div class="table">
        <!-- Table Heading -->
        <div class="table--heading2">
          <p>Item Description</p>
          <p>Unit Price</p>
          <p>Qty</p>
          <p>Total</p>
          <p></p>
        </div>

        <!-- Table Items -->
        <div v-for="(item, index) in items" :key="index" class="table--items2">
          <p>{{ item.description }}</p>
          <p><input v-model="item.unitPrice" type="text" class="form-control"></p>
          <p><input v-model="item.quantity" type="text" class="form-control"></p>
          <p>${{ item.unitPrice * item.quantity }}</p>
          <p style="color: red; font-size: 24px; cursor: pointer;" @click="removeItem(index)">&times;</p>
        </div>

        <!-- Add New Line Button -->
        <div style="padding: 10px 30px !important;">
          <button class="btn btn-sm btn-primary" @click="addNewItem">Add New Line</button>
        </div>
      </div>

      <!-- Table Footer -->
      <div class="table__footer">
        <div class="document-footer">
          <p>Terms and Conditions</p>
          <textarea v-model="termsAndConditions" cols="50" rows="7" class="form-control"></textarea>
        </div>
        <div>
          <div class="table__footer--subtotal">
            <p>Sub Total</p>
            <span>${{ calculateSubTotal() }}</span>
          </div>
          <div class="table__footer--discount">
            <p>Discount</p>
            <input v-model="discount" type="text" class="form-control">
          </div>
          <div class="table__footer--total">
            <p>Grand Total</p>
            <span>${{ calculateGrandTotal() }}</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Card Footer -->
    <div class="card__header" style="margin-top: 40px;">
      <div></div>
      <div>
        <button class="btn btn-secondary" @click="saveInvoice">Save</button>
      </div>
    </div>
  </div>
  <div class="modal main__modal" v-show="isOpen">
    <div class="modal__content">
      <span class="modal__close btn__close--modal" @click="closeModal">×</span>
      <h3 class="modal__title">Add Item</h3>
      <hr><br>
      <div class="modal__items">
        <select v-model="selectedItem" class="form-select my-1">
          <option value="None">None</option>
          <option value="LBC Padala">LBC Padala</option>
        </select>
      </div>
      <br><hr>
      <div class="modal__footer">
        <button class="btn btn-light mr-2 btn__close--modal" @click="closeModal">
          Cancel
        </button>
        <button class="btn btn-light btn__close--modal" @click="saveItem">
          Save
        </button>
      </div>
    </div>
  </div>
</div>
  <!--==================== APP JS ====================-->
</template>