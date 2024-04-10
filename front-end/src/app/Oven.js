class Oven {

    constructor(width, height) {
        this._width = width;
        this._height = height;

        this.setOven();
    }

    // Draw attributes of oven
    setOven() {
        document.querySelector('#ovenWidth').innerHTML = this._width;
        document.querySelector('#ovenHeight').innerHTML = this._height;
    }

}