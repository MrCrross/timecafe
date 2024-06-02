class OrderForm {
    static btnAddLineSelector = '.add-line-Order';
    static btnRemoveLineSelector = '.remove-line-Order';
    static containerLineSelector = '.container-line-Order';
    static lineOrderClass = 'line-Order';
    static lineOrderCloneSelector = '#line-clone-Order';
    static keyLine = 0;


    constructor() {
        OrderForm.addListeners();
    }

    static addListeners()
    {
        const addBtns = document.querySelectorAll(OrderForm.btnAddLineSelector);
        const removeBtns = document.querySelectorAll(OrderForm.btnRemoveLineSelector);
        const inputCheckBox = document.querySelectorAll('.input_checkbox');
        const containerLines = document.querySelectorAll('.' + OrderForm.lineOrderClass);

        if (addBtns) {
            addBtns.forEach((btn) => {
                btn.addEventListener('click', (event) => OrderForm.addNewLine(event));
            });
        }
        if (removeBtns) {
            removeBtns.forEach((btn) => {
                btn.addEventListener('click', (event) => OrderForm.removeLine(event));
            });
        }
        if (inputCheckBox) {
            inputCheckBox.forEach((checkBox) => {
                checkBox.addEventListener('change', (event) => {
                    const target = event.target;
                    if (target.checked) {
                        target.value = 2;
                    } else {
                        target.value = 1;
                    }
                });
            })
        }

        if (containerLines) {
            containerLines.forEach((line) => {
                const productID = line.querySelector('#product_id');
                const productPrice = productID.selectedOptions[0].getAttribute('data-price')
                const productPriceElement = line.querySelector('#product_price');
                const productCount = line.querySelector('#count');

                productID.addEventListener('change', (event) => OrderForm.refreshProductPrice(event));
                productCount.addEventListener('change', (event) => OrderForm.refreshProductPrice(event));

                productPriceElement.innerHTML = +productPrice * +productCount.value;
                OrderForm.refreshOrderPrice()
            })
        }
    }

    static addNewLine(event)
    {
        const clone = OrderForm.getClone();
        const container = document.querySelector(OrderForm.containerLineSelector);
        container.append(clone);
    }

    static removeLine(event)
    {
        const line = OrderForm.getLineOrder(event.target);
        line.remove()
    }

    static getLineOrder(element)
    {
        while(element = element.parentElement) {
            if (element.classList.contains(OrderForm.lineOrderClass)) {
                return element;
            }
        }
    }

    static getClone()
    {
        OrderForm.keyLine++;
        const clone = document.querySelector(OrderForm.lineOrderCloneSelector).cloneNode(true);
        const productID = clone.querySelector('#product_id');
        const productPrice = productID.selectedOptions[0].getAttribute('data-price')
        const productPriceElement = clone.querySelector('#product_price');
        const count = clone.querySelector('#count');
        const addBtn = clone.querySelector(OrderForm.btnAddLineSelector);
        const removeBtn = clone.querySelector(OrderForm.btnRemoveLineSelector);
        clone.id = '';
        clone.classList.remove('hidden');
        addBtn.remove();
        removeBtn.addEventListener('click', (event) => OrderForm.removeLine(event));
        removeBtn.classList.remove('hidden');
        productID.setAttribute('name', "products[" + OrderForm.keyLine + "][id]");
        count.setAttribute('name', "products[" + OrderForm.keyLine + "][count]");
        count.addEventListener('change', (event) => OrderForm.refreshProductPrice(event));

        productPriceElement.innerHTML = +productPrice * +count.value;
        OrderForm.refreshOrderPrice()
        return clone;
    }

    static addProductsReservation(event)
    {
        const reservationProductsContainer = document.querySelector('#reservationProductsContainer');
        const container = document.querySelector(OrderForm.containerLineSelector);
        const productsIds = container.querySelectorAll('#product_id')
        const productsCount = container.querySelectorAll('#count')
        const emptyHiddenInput = document.createElement('input')
        emptyHiddenInput.setAttribute('hidden', 'hidden')
        reservationProductsContainer.innerHTML = '';
        productsIds.forEach((line) => {
            const cloneEmptyInput = emptyHiddenInput.cloneNode(true)
            cloneEmptyInput.setAttribute('name', line.getAttribute('name'))
            cloneEmptyInput.value = line.value
            reservationProductsContainer.append(cloneEmptyInput)
        })
        productsCount.forEach((line) => {
            const cloneEmptyInput = emptyHiddenInput.cloneNode(true)
            cloneEmptyInput.setAttribute('name', line.getAttribute('name'))
            cloneEmptyInput.value = line.value
            reservationProductsContainer.append(cloneEmptyInput)
        })
    }

    static refreshProductPrice(event)
    {
        const line = OrderForm.getLineOrder(event.target)
        const productID = line.querySelector('#product_id');
        const productCount = line.querySelector('#count');
        const productPrice = productID.selectedOptions[0].getAttribute('data-price')
        const productPriceElement = line.querySelector('#product_price');

        productPriceElement.innerHTML = +productPrice * +productCount.value;
        OrderForm.refreshOrderPrice()
    }

    static refreshOrderPrice()
    {
        const orderPriceElement = document.querySelector('span#order_price')
        let orderPrice = 0
        const containerLines = document.querySelectorAll('.' + OrderForm.lineOrderClass);
        containerLines.forEach((line) => {
            const productPrice = line.querySelector('#product_price')
            orderPrice += +productPrice.innerHTML
        })
        orderPriceElement.innerHTML = orderPrice
    }
}
