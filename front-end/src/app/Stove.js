class Stove {

    constructor(color, width, height, length, brand, burners, lighters, oven) {
        this._color = color;
        this._width = width;
        this._height = height;
        this._length = length;
        this._brand = brand;
        this._burners = burners;
        this._lighters = lighters;
        this._oven = oven;

        this._lamp = false;

        this.startsStove();
    }

    // Return data from Stove in console.log
    stoveInfo() {
        console.log(this);
    }

    // Starts the stove and draw burners and lighters
    startsStove() {

        this.setStove();
        this.createBurners();
        this.createLighters();

        this.stoveInfo()

    }

    // Draw attributes of stove
    setStove() {
        document.querySelector('.stoveBody').setAttribute('style', 'background-color: ' + this._color);
        document.querySelector('#stoveWidth').innerHTML = this._width;
        document.querySelector('#stoveHeight').innerHTML = this._height;
        document.querySelector('#stoveLength').innerHTML = this._length;
        document.querySelector('#brand').innerHTML = this._brand;
    }

    // Draw burners
    createBurners() {
        for (var cont = 0; cont < this._burners; cont++) {
            let div = document.createElement('div');
            div.classList.add("burner")
            document.querySelector('.burnerBox').appendChild(div);
        }
    }

    // Draw lighters
    createLighters() {
        this._lighters.forEach((lighter, key) => {
            let div = document.createElement('div');
            div.classList.add("lighterBtn");
            div.setAttribute('style', 'background-color: ' + lighter.color);

            if (key < this._lighters.length - 1)
                div.setAttribute('onclick', 'stove.burnerToggle(this, ' + key + ')');
            else
                div.setAttribute('onclick', 'stove.ovenToggle(this, ' + key + ')');

            document.querySelector('.lighterBox').appendChild(div);
        });
    }

    // Toggle lamp on (true) and off (false)
    lampToggle() {

        if (!this._lamp) {
            document.querySelector('.glass').classList.add('on');

            this._lamp = true;
        } else {
            document.querySelector('.glass').classList.remove('on');

            this._lamp = false;
        }

        this.stoveInfo()

    }

    // Call method in Lighter.js to toggle burner
    burnerToggle(element, id) {

        this._lighters[id].burnerToggle(element, id);
        this.stoveInfo()

    }

    // Call method in Lighter.js to toggle oven
    ovenToggle(element, id) {

        this._lighters[id].ovenToggle(element);
        this.stoveInfo()

    }

}