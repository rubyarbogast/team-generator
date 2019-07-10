class Player {
    constructor(name, number, position, currentTeam, teamAbbr) {
        this.name = name;
        this.number = number;
        this.position = position;
        this.currentTeam = currentTeam;
        this.teamAbbr = teamAbbr;
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

    getTeamAbbr() {
        return this.teamAbbr;
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

    setTeamAbbr(value) {
        this.teamAbbr = value;
    }
}

module.exports = Player;