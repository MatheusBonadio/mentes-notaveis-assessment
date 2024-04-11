var maxBurners = 10;
var maxOvens = 5;

class Stove {

    /**
     * Creates a new Stove object.
     * @constructor
     * @param {string} color - The color of the stove.
     * @param {number} width - The width of the stove.
     * @param {number} height - The height of the stove.
     * @param {number} length - The length of the stove.
     * @param {string} brand - The brand of the stove.
     * @param {number} burners - The number of burners on the stove.
     * @param {Lighter[]} lighters - The array of lighters on the stove.
     * @param {Oven[]} ovens - The array of ovens on the stove.
     */
    constructor(color, width, height, length, brand, burners, lighters, ovens) {
        this._id = crypto.randomUUID();
        this._color = color;
        this._width = width;
        this._height = height;
        this._length = length;
        this._brand = brand;
        this._burners = burners;
        this._lighters = lighters;
        this._ovens = ovens;

        this.startsStove();
    }

    /* --- */

    /**
     * Starts the stove by rendering the stove, lighters, burners, and ovens,
     * and displaying the stove information.
     */
    startsStove() {
        this.verifyStove();

        this.renderLighters();
        this.renderBurners();
        this.renderOvens();
        this.renderStove();

        this.stoveInfo()
    }

    /**
     * Verifies if the number of lighters is equal to the sum of ovens and burners.
     * Throws an error and displays an alert if the number of lighters is not correct.
     */
    verifyStove() {
        var message = 'The number of lighters is less or more than enough';

        if (this._lighters.length != this._ovens.length + this._burners) {
            alertError(message);
            throw { 'Error': message };
        }
    }

    /**
     * Logs the stove object to the console.
     */
    stoveInfo() {
        console.log(this);
    }

    /**
     * Creates a new burner element and appends it to the burnerBox container.
     * @param {int} key - The unique identifier for the burner.
     */
    createBurner(key) {
        let burnerDiv = document.createElement('div');
        burnerDiv.id = `burner_${key}`;
        burnerDiv.classList.add('burner')
        document.querySelector('.burnerBox').appendChild(burnerDiv);
    }

    /**
     * Renders the stove by setting the background color and dimensions.
     */
    renderStove() {
        document.querySelector('.stoveBody').setAttribute('style', `background-color: ${this._color}`);
        document.querySelector('#stoveWidth').innerHTML = this._width;
        document.querySelector('#stoveHeight').innerHTML = this._height;
        document.querySelector('#stoveLength').innerHTML = this._length;
        document.querySelector('.brand').innerHTML = this._brand;
    }

    /**
     * Renders the burners by creating burner elements.
     */
    renderBurners() {
        for (var i = 0; i < this._burners; i++)
            this.createBurner(i);
    }

    /**
     * Renders the lighters by creating lighter elements for burners and ovens.
     */
    renderLighters() {
        var index = 0;

        this._lighters.forEach((lighter, key) => {
            if (key < this._burners)
                lighter.createLighterBurner();
            else {
                lighter.createLighterOven(this._ovens[index]._id);
                index++;
            }
        });
    }

    /**
     * Renders the ovens by creating oven and lamp elements.
     */
    renderOvens() {
        this._ovens.forEach(oven => {
            oven.createOven();
            oven.createLamp();
        });
    }

    /**
     * Adds a burner to the stove.
     * Displays an error message if the maximum number of burners is reached.
     */
    addBurner() {
        if (this._burners < maxBurners) {
            var lighter = new Lighter('#fff');

            lighter.createLighterBurner();
            this.createBurner(this._lighters.length);

            this._lighters.push(lighter);
            this._burners++;

            this.stoveInfo()
        } else
            alertError(`Limit of burners reached (${maxBurners})`);
    }

    /**
     * Removes a burner from the stove.
     */
    removeBurner() {
        if (this._burners > 1) {
            var burners = document.querySelectorAll('.burner');
            document.querySelectorAll('.burner')[burners.length - 1].remove();

            var lighter = document.querySelectorAll('[onclick^="stove.burnerSwitch"]');
            var uuid_lighter = lighter[this._burners - 1].id.split('_')[1];
            document.getElementById(`lighter_${uuid_lighter}`).remove();

            this._lighters = this._lighters.filter(lighter => lighter._id !== uuid_lighter);
            this._burners--;

            this.stoveInfo()
        } else
            alertError('At least 1 burner is required');
    }

    /**
     * Adds an oven to the stove.
     * Displays an error message if the maximum number of ovens is reached.
     */
    addOven() {
        if (this._ovens.length < maxOvens) {
            var lighter = new Lighter('#fff');
            var oven = new Oven('60 cm', '50 cm');

            oven.createOven();
            oven.createLamp();
            lighter.createLighterOven(oven._id);

            this._ovens.push(oven);
            this._lighters.push(lighter);

            this.stoveInfo()
        } else
            alertError(`Limit of ovens reached (${maxOvens})`);
    }

    /**
     * Removes the last oven from the stove.
     * If there is only one oven remaining, displays an error message.
     */
    removeOven() {
        if (this._ovens.length > 1) {
            var lamps = document.querySelectorAll('.lampBtn');
            document.querySelectorAll('.lampBtn')[lamps.length - 1].remove();

            var ovens = document.querySelectorAll('.oven');
            document.querySelectorAll('.oven')[ovens.length - 1].remove();

            var lighter = document.querySelectorAll('[onclick^="stove.ovenSwitch"]');
            var uuid_lighter = lighter[this._ovens.length - 1].id.split('_')[1];
            document.getElementById(`lighter_${uuid_lighter}`).remove();

            this._lighters = this._lighters.filter(lighter => lighter._id !== uuid_lighter);
            this._ovens.pop();

            this.stoveInfo()
        } else
            alertError('At least 1 oven is required');
    }

    /**
     * Toggles the lamp of the specified oven on or off.
     * @param {string} uuid - The unique identifier for the oven.
     */
    lampSwitch(uuid) {
        var oven = this._ovens.find(oven => oven._id === uuid);

        oven.lampSwitch();
        this.stoveInfo()
    }

    /**
     * Toggles the burner of the specified lighter on or off.
     * @param {HTMLElement} element - The HTML element representing the lighter.
     * @param {string} uuid - The unique identifier for the lighter.
     */
    burnerSwitch(element, uuid) {
        var lighter = this._lighters.find(lighter => lighter._id === uuid);
        var index = this._lighters.indexOf(lighter);

        lighter.burnerSwitch(element, index);
        this.stoveInfo()
    }

    /**
     * Toggles the oven of the specified lighter and oven on or off.
     * @param {HTMLElement} element - The HTML element representing the lighter.
     * @param {string} uuid_lighter - The unique identifier for the lighter.
     * @param {string} uuid_oven - The unique identifier for the oven.
     */
    ovenSwitch(element, uuid_lighter, uuid_oven) {
        var oven = this._ovens.find(oven => oven._id === uuid_oven);
        var lighter = this._lighters.find(lighter => lighter._id === uuid_lighter);

        lighter.ovenSwitch(element, uuid_oven);
        oven.onToggle();
        this.stoveInfo()
    }

    /**
     * Toggles the door of the specified oven on or off.
     * @param {string} uuid - The unique identifier for the oven.
     */
    doorSwitch(uuid) {
        var oven = this._ovens.find(oven => oven._id === uuid);

        oven.doorSwitch();
        this.stoveInfo()
    }

}