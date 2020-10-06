import React from 'react'
import { useStore } from '../Context'
import { Player } from '../types'

interface Props {
  player: Player
}

const Card: React.FC<Props> = ({ player }) => {
  const { openCard, setPlayer } = useStore()

  const openMessage = () => {
    setPlayer(player)
    openCard()
  }

  return (
    <div className="card">
      <figure className="card__number">
        <img src={player.label} alt="" />
      </figure>
      <div className="card__controls">
        <button className="card__btn btn btn--orange btn--dashed" type="button" onClick={openMessage}>Открыть</button>
      </div>
    </div>
  )
}

export default Card
