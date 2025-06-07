function updatePrice(selectElement) {
    let selectedOption = selectElement.options[selectElement.selectedIndex];
    let unitPrice = selectedOption.getAttribute("data-unit-price");
    let profitPerPiece = selectedOption.getAttribute("data-profit-per-piece");

    // إيجاد الحقول المرتبطة بنفس الصف
    let row = selectElement.closest(".inputs");
    let quantityInput = row.querySelector("input[name='quantity[]']");
    let totalCostInput = row.querySelector("input[name='total_cost[]']");
    let totalProfitInput = row.querySelector("input[name='total_profit[]']");

    // عند تغيير الكمية، حساب القيم تلقائيًا
    quantityInput.addEventListener("input", function () {
        let quantity = parseInt(this.value) || 0;
        totalCostInput.value = (quantity * parseFloat(unitPrice)).toFixed(2);
        totalProfitInput.value = (quantity * parseFloat(profitPerPiece)).toFixed(2);
    });
}


// function addRow() {
//     let container = document.getElementById("exportContainer");
    
//     let newRow = document.createElement("div");
//     newRow.classList.add("row", "exportRow");

//     newRow.innerHTML = `
//        <div class="col-11">
//                             <div class="inputs">
//                                 <div class="input">
//                                     <label>Product Name</label>
//                                     <select name="product_id[]" class="form-select" onchange="updatePrice(this)" required>
//                                         <option value="">Select product</option>
//                                         <?php
//                                         $query = "SELECT * FROM products WHERE user_id = ?";
//                                         $stmt = $conn->prepare($query);
//                                         $stmt->bind_param("i", $_SESSION['id']);
//                                         $stmt->execute();
//                                         $result = $stmt->get_result();

                                        
//                                         while ($row = $result->fetch_assoc()) {
//                                             echo "<option value='" . $row['id'] . "' 
//                                                 data-unit-price='" . $row['unit_cost'] . "' 
//                                                 data-profit-per-piece='" . $row['profit_margin'] . "'>"
//                                                 . $row['product_name'].
//                                                 "</option>";
//                                         }
//                                         ?>
//                                     </select>
//                                 </div>
//                                 <div class="input">
//                                     <label>Arrival Date</label>
//                                     <input type="date" name="arrival_date[]">
//                                 </div>
//                                 <div class="input">
//                                     <label>Quantity</label>
//                                     <input type="number" name="quantity[]" min="1" oninput="calculateTotal(this)">
//                                 </div>
//                                 <div class="input">
//                                     <label>Total Cost</label>
//                                     <input type="text" name="total_cost[]" readonly>
//                                 </div>
//                                 <div class="input">
//                                     <label>Total Profit</label>
//                                     <input type="text" name="total_profit[]" readonly>
//                                 </div>
//                             </div>
//                         </div>
//                         <div class="col-1">
//                             <i class="fa-solid fa-circle-plus add-product" onclick="addRow()"></i>
//                             <i class="fa-solid fa-circle-minus delete-product" onclick="removeRow(this)"></i>
//                         </div>
//     `;

//     container.appendChild(newRow);
// }
function addRow() {
    let container = document.getElementById("exportContainer");

    let newRow = document.createElement("div");
    newRow.classList.add("row", "exportRow");

    newRow.innerHTML = `
        <div class="col-11">
            <div class="inputs">
                <div class="input">
                    <label>Product Name</label>
                    <select name="product_id[]" class="form-select" onchange="updatePrice(this)" required>
                        <option>Loading...</option>
                    </select>
                </div>
                <div class="input">
                    <label>Arrival Date</label>
                    <input type="date" name="arrival_date[]">
                </div>
                <div class="input">
                    <label>Quantity</label>
                    <input type="number" name="quantity[]" min="1" oninput="calculateTotal(this)">
                </div>
                <div class="input">
                    <label>Total Cost</label>
                    <input type="text" name="total_cost[]" readonly>
                </div>
                <div class="input">
                    <label>Total Profit</label>
                    <input type="text" name="total_profit[]" readonly>
                </div>
            </div>
        </div>
        <div class="col-1">
            <i class="fa-solid fa-circle-plus add-product" onclick="addRow()"></i>
            <i class="fa-solid fa-circle-minus delete-product" onclick="removeRow(this)"></i>
        </div>
    `;

    container.appendChild(newRow);

    // AJAX
    fetch('get_products.php')
        .then(response => response.text())
        .then(data => {
            newRow.querySelector("select[name='product_id[]']").innerHTML = data;
        })
        .catch(error => console.error("Error loading products:", error));
}

function removeRow(button) {
    let row = button.closest(".row");
    if (document.querySelectorAll(".exportRow").length > 1) {
        row.remove();
    }
}
