class Player {
    constructor(name, number, position, currentTeam) {
        this.name = name;
        this.number = number;
        this.position = position;
        this.currentTeam = currentTeam;
    }

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
        this.name = value;
    }

    setNumber(value) {
        this.number = value;
    }

    setPosition(value) {
        this.position = value;
    }

    setCurrentTeam(value) {
        this.currentTeam = value;
    }
}

module.exports = Player;