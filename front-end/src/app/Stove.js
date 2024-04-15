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
        this.refreshNumbers();

        this.stoveInfo()
    }

    /**
     * Verifies if the number of lighters is equal to the sum of ovens and burners.
     * Throws an error and displays an alert if the number of lighters is not correct.
     */
    verifyStove() {
        if (this._lighters.length != this._ovens.length + this._burners.length) {
            var message = '❌ The number of lighters is less or more than enough';

            alertMessage(message, 'error');
            throw { 'Error': message };
        }

        if (typeof maxOvens === 'undefined') {
            var message = '❌ The maximum value of stoves is required';

            alertMessage(message, 'error');
            throw { 'Error': message };
        }

        if (typeof maxBurners === 'undefined') {
            var message = '❌ The maximum value of burners is required';

            alertMessage(message, 'error');
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
     * Renders the stove by setting the background color and dimensions.
     */
    renderStove() {
        document.querySelector('.stoveBody').setAttribute('style', `background-color: ${this._color}`);
        document.querySelector('#stoveWidth').innerHTML = this._width;
        document.querySelector('#stoveHeight').innerHTML = this._height;
        document.querySelector('#stoveLength').innerHTML = this._length;
        document.querySelector('.brand').innerHTML = this._brand;
    }

    refreshNumbers() {
        document.querySelector('#stoveBurners').innerHTML = `BURNERS (${this._burners.length})`;
        document.querySelector('#stoveOvens').innerHTML = `OVENS (${this._ovens.length})`;
    }

    /**
     * Renders the burners by creating burner elements.
     */
    renderBurners() {
        this._burners.forEach((burner) => {
            burner.createBurner();
        });
    }

    /**
     * Renders the lighters by creating lighter elements for burners and ovens.
     */
    renderLighters() {
        var index = 0;

        this._lighters.forEach((lighter, key) => {
            if (key < this._burners.length)
                lighter.createLighterBurner(this._burners[key]._id);
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
        if (this._burners.length < maxBurners) {
            var lighter = new Lighter('#fff');
            var burner = new Burner();

            burner.createBurner();
            this._burners.push(burner);

            lighter.createLighterBurner(burner._id);
            this._lighters.push(lighter);

            this.refreshNumbers()
            this.stoveInfo()
        } else
            alertMessage(`⚠️ Limit of burners reached (${maxBurners})`, 'warning');
    }

    /**
     * Removes a burner from the stove.
     */
    removeBurner() {
        if (this._burners.length > 1) {
            var burners = document.querySelectorAll('.burner');
            document.querySelectorAll('.burner')[burners.length - 1].remove();

            var lighter = document.querySelectorAll('[onclick^="stove.burnerSwitch"]');
            var uuid_lighter = lighter[this._burners.length - 1].id.split('_')[1];
            document.getElementById(`lighter_${uuid_lighter}`).remove();

            this._lighters = this._lighters.filter(lighter => lighter._id !== uuid_lighter);
            this._burners.pop();

            this.refreshNumbers()
            this.stoveInfo()
        } else
            alertMessage('⚠️ At least 1 burner is required', 'warning');
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

            this.refreshNumbers()
            this.stoveInfo()
        } else
            alertMessage(`⚠️ Limit of ovens reached (${maxOvens})`, 'warning');
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

            this.refreshNumbers()
            this.stoveInfo()
        } else
            alertMessage('⚠️ At least 1 oven is required', 'warning');
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
    burnerSwitch(element, uuid_lighter, uuid_burner) {
        var burner = this._burners.find(burner => burner._id === uuid_burner);
        var lighter = this._lighters.find(lighter => lighter._id === uuid_lighter);

        lighter.burnerSwitch(element, uuid_burner);
        burner.litedToggle();
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