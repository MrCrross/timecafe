class UserForm {
    static btnAddLineSelector = '.add-line-UserParam';
    static btnRemoveLineSelector = '.remove-line-UserParam';
    static containerLineSelector = '.container-line-UserParam';
    static lineUserParamClass = 'line-UserParam';
    static lineUserParamCloneSelector = '#line-clone-UserParam';


    constructor() {
        UserForm.addListeners();
    }

    static addListeners()
    {
        const addBtns = document.querySelectorAll(UserForm.btnAddLineSelector);
        const removeBtns = document.querySelectorAll(UserForm.btnRemoveLineSelector);
        const inputCheckBox = document.querySelectorAll('.input_checkbox');

        if (addBtns) {
            addBtns.forEach((btn) => {
                btn.addEventListener('click', (event) => UserForm.addNewLine(event));
            });
        }
        if (removeBtns) {
            removeBtns.forEach((btn) => {
                btn.addEventListener('click', (event) => UserForm.removeLine(event));
            });
        }
        if (inputCheckBox) {
            inputCheckBox.forEach((checkBox) => {
                checkBox.addEventListener('change', (event) => {
                    const target = event.target;
                    if (target.checked) {
                        target.value = 1;
                    } else {
                        target.value = 0;
                    }
                });
            })
        }
    }

    static addNewLine(event)
    {
        const clone = UserForm.getClone();
        const container = document.querySelector(UserForm.containerLineSelector);
        container.append(clone);
    }

    static removeLine(event)
    {
        const line = UserForm.getLineUserParam(event.target);
        line.remove()
    }

    static getLineUserParam(element)
    {
        while(element = element.parentElement) {
            if (element.classList.contains(UserForm.lineUserParamClass)) {
                return element;
            }
        }
    }

    static getClone()
    {
        const clone = document.querySelector(UserForm.lineUserParamCloneSelector).cloneNode(true);
        const addBtn = clone.querySelector(UserForm.btnAddLineSelector);
        const removeBtn = clone.querySelector(UserForm.btnRemoveLineSelector);
        clone.id = '';
        clone.classList.remove('hidden');
        addBtn.remove();
        removeBtn.addEventListener('click', (event) => UserForm.removeLine(event));
        removeBtn.classList.remove('hidden');
        return clone;
    }
}
