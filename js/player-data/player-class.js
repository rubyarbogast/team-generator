class Player {
    constructor(name, number, position, currentTeam) {
        this.name = name;
        this.number = number;
        this.position = position;
        this.currentTeam = currentTeam;
    }

    //TODO: add delete function? or just delete from array?

    getName() {
        return this.name;
    }

    getNumber() {
        return this.number;
    }

    getPosition() {
        return this.position;
    }

    getCurrentTeam() {
        return this.currentTeam;
    }

    setName(value) {
        this._name = value;
    }

    setNumber(value) {
        this._number = value;
    }

    setPosition(value) {
        this._position = value;
    }

    setCurrentTeam(value) {
        this._team = value;
    }
}

module.exports = Player;