import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**", "../fonts/**"]);




document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('hype-custom-nav')) {
        const header = document.getElementById('hype-custom-nav')
        setTimeout(() => {
            header.style.transition = 'transform 0.3s ease-out';
        }, 200);
        const headerHandler = new HypeNav(header);


        // Aggiungi un listener per il clic sul pulsante di ricerca
        document.getElementById('hype-nav-search-button').addEventListener('click', function (event) {
            headerHandler.toggleMenu('hype-nav-search-bar-input', event.currentTarget);
        });

        // Aggiungi un listener per il clic sul pulsante di chiusura della ricerca
        document.getElementById('hype-nav-login-button').addEventListener('click', function (event) {
            headerHandler.toggleMenu('hype-nav-login-bar-input', event.currentTarget);
        });

        document.getElementById('hype-nav-kebab-button').addEventListener('click', function (event) {
            headerHandler.toggleMenu('hype-nav-kebab-menu', event.currentTarget);
        });

        document.querySelectorAll('.go-to-login').forEach((element) => {
            element.addEventListener('click', (event) => {
                event.preventDefault();
                headerHandler.toggleMenu('hype-nav-login-bar-input', document.getElementById('hype-nav-login-button'));
            })
        })
    }

});
class HypeNav {
    constructor(hypeElement) {
        this.hypeElement = hypeElement;
        this.openElement = '';
        this.eventTarget = {
            orignaltemplate: '',
            eventElement: ''
        }
        this.initialPositionWindow = 0;
        this.updateScrollPosition = this.updateScrollPosition.bind(this);
        this.render = this.render.bind(this);
        window.addEventListener('scroll', this.updateScrollPosition);
        this.render();
    }

    checkMovement() {
        return this.initialPositionWindow !== 0; //return true or false
    }

    updateScrollPosition() {
        const currentScrollPosition = window.scrollY;
        if (currentScrollPosition !== this.initialPositionWindow || this.openMenu !== '') {
            this.initialPositionWindow = currentScrollPosition;
            this.render();
        }
    }

    toggleMenu(menuItem, eventTarget) {
        const menuToOpen = document.getElementById(menuItem);
        if (this.openElement === menuToOpen) {
            menuToOpen.classList.toggle('d-none');
            eventTarget.classList.remove('active-color');
            eventTarget.innerHTML = this.eventTarget.orignaltemplate;
            this.hypeElement.classList.remove('border-opened-menu');
            this.openElement = '';
        } else {
            this.closeAll();
            this.openElement = menuToOpen;
            this.eventTarget.eventElement = eventTarget;
            this.eventTarget.orignaltemplate = eventTarget.innerHTML;
            //console.log(this.eventTarget);
            eventTarget.classList.add('active-color');
            eventTarget.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            menuToOpen.classList.toggle('d-none');
            this.hypeElement.classList.add('border-opened-menu');
        }

    }

    closeAll() {
        this.openElement !== '' ? this.openElement.classList.add('d-none') : '';
        if (this.eventTarget.eventElement !== '') {
            this.eventTarget.eventElement.classList.remove('active-color');
            this.eventTarget.eventElement.innerHTML = this.eventTarget.orignaltemplate;
        }
    }

    render() {
        const renderElement = this.hypeElement;
        renderElement.classList.toggle('window-movement', this.checkMovement());
    }

}




document.querySelectorAll('.element-delete').forEach((element) => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        const ElementId = element.getAttribute('data-element-id');
        const ElementName = element.getAttribute('data-element-title');
        createModal(ElementId, ElementName);
        const HypeModal = document.getElementById('hype-modal');
        const myModal = new bootstrap.Modal(HypeModal)
        myModal.show();
        const btnSave = HypeModal.querySelector('.modal-delete-button')
        btnSave.addEventListener('click', () => {
            element.parentElement.submit();
            HypeModal.remove();
        })
        const buttons = Array.from(HypeModal.getElementsByTagName('button'));
        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                HypeModal.remove();
            });
        });
    })
})
function createModal(ElementId, ElementName) {
    const modal = document.createElement('div');
    modal.classList.add('modal', 'fade');
    modal.setAttribute('id', 'hype-modal');
    modal.setAttribute('tabindex', '-1');
    modal.setAttribute('aria-labelledby', 'exampleModalLabel');
    modal.setAttribute('aria-hidden', 'true');
    let tmp = `<div class="modal-dialog modal-dialog-centered">
          <div class="modal-content background-gradient-modal text-white hype-shadow-white">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Cancellazione elemento: ${ElementName} - id: ${ElementId}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Sei sicuro di voler eliminare l'elemento con id: ${ElementId} e titolo: ${ElementName}?
            </div>
            <div class="modal-footer">
              <button type="button" class="mine-custom-btn min-custom-btn-grey" data-bs-dismiss="modal">No, torna indietro</button>
              <button type="button" class="mine-custom-btn modal-delete-button">Si, cancella</button>
            </div>
          </div>
        </div>`
    modal.innerHTML = tmp;
    document.body.appendChild(modal);
}


document.querySelectorAll('#hype-sidebar-collapse').forEach((element) => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        const HypeSidebar = document.getElementById('sidebar');
        document.querySelectorAll('.hype-text-collapse').forEach((element) => {
            element.classList.toggle('d-none');
        })
        HypeSidebar.classList.toggle('sidebard-collapse');
    })
})




//prendo la casella di input
const image = document.getElementById('upload_image');
//controllo che esista e se c'è eseguo il codice sottostante
if (image) {
    //aggiungo un listener per quando l'utente cambia il valore
    image.addEventListener('change', (event) => {
        //console.log(image.files[0]);
        //prendo l'elemento dove visualizzare la preview
        const preview = document.getElementById('uploadPreview');
        //creao un nuovo oggetto di tipo FileReader
        const reader = new FileReader();
        //leggo il contenuto del file
        reader.readAsDataURL(image.files[0]);
        reader.onload = function (event) {
            preview.src = event.target.result;
        };
    });
}