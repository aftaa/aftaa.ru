export interface Ctx {
  message: boolean
  player: Player
  setPlayer (player: Player): void
  help: boolean,
  openCard (): void
  nextStep (): void
  step: number
  time: number
  closeAllPopups(): void
}

export interface Player {
  number: number,
  name: string,
  label: string,
  photo: string,
  prize: boolean
}
