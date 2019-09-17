class Player {
    constructor(nhlId, name, number, position, currentTeam, teamAbbr, active) {
        this.nhlId = nhlId;
        this.name = name;
        this.number = number;
        this.position = position;
        this.currentTeam = currentTeam;
        this.teamAbbr = teamAbbr;
        this.active = active;
    }

    getNhlId() {
        return this.nhlId;
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

    getActive( ){
        return this.active;
    }

    setNhlId(value) {
        this.nhlId = value;
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

    setActive(value) {
        this.active = value;
    }
}

module.exports = Player;