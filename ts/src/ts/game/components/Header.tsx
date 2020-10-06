import React from 'react'
import { useStore } from '../Context'

const Header: React.FC = () => {
  const { step, time } = useStore()

  return (
    <header className="game__header container">
      <h2 className="game__title title">Угадай, под каким номером спрятан приз</h2>
      <div className="game__counter game__counter--try">
        <div>
          <h3>Попытки</h3>
          <p><span>{step}</span>/3</p>
        </div>
      </div>
      <div className="game__counter game__counter--time">
        <div>
          <h3>Твое время (сек)</h3>
          <p><span>{time}</span>/15</p>
        </div>
      </div>
    </header>
  )
}

export default Header
