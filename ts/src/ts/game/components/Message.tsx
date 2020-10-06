import React from 'react'
import { useStore } from '../Context'

const Message: React.FC = () => {
  const { nextStep, player } = useStore()
  const { number, name, photo, prize } = player

  const renderSuccess = () => {
    return (
      <div className="message__success">
        <h3 className="message__title"><span>Поздравляем!</span> <span>Под номером</span> <span>этого игрока</span> <span>приз!</span></h3>
        <figure className="message__prize">
          <img src="/static/img/message-prize.png" alt="" />
        </figure>
        <div className="message__text">
          <h4>Футболка</h4>
          <p>с&nbsp;автографами игроков команды &laquo;Зенит&raquo;</p>
          <p>Организаторы свяжутся с&nbsp;вами после верификации отсканированного чека</p>
        </div>
      </div>
    )
  }

  const renderFail = () => {
    return (
      <div className="message__fail">
        <h3 className="message__title"><span>Увы!</span> Под номером этого игрока нет приза, поищи получше</h3>
      </div>
    )
  }

  return (
    <div className="message popup">
      <div className="popup__overlay" />

      <div className={`message__container message__container--${status}`}>
        <header className="message__header">
          <figure className="message__photo">
            <img src={photo} alt=""/>
          </figure>
          <div className="message__person">
          <p className="message__number">{number}</p>
            <p className="message__name">{name}</p>
          </div>
          <button className="message__close" type="button" aria-label="Закрыть" onClick={nextStep} />
        </header>

        {prize ? renderSuccess() : renderFail()}
      </div>
    </div>
  )
}

export default Message
