import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["list", "new"];
    connect() {
        this.newTarget.hidden = true;
    }
    close(){
        this.listTarget.hidden = true;
        this.newTarget.hidden = false;
    }
    list(){  
        this.newTarget.hidden = true;
        this.listTarget.hidden = false;
    }
}