import React from 'react'
import ReactDOM from 'react-dom'
import Header from './components/Header'
import Slider from './components/Slider'
import Message from './components/Message'
import Help from './components/Help'
import { Provider, useStore } from './Context'

const Game = () => {
  const { message, help } = useStore()

  return (
    <section className="game">
      <Header />
      <Slider />
      {message && <Message />}
      {help && <Help />}
    </section>
  )
}

const root = document.querySelector('#game')
root && ReactDOM.render(
  <Provider>
    <Game />
  </Provider>,
  root
)
