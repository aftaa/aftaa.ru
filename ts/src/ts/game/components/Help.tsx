import React, { useState } from 'react'
import { useStore } from '../Context'
import questions from '../stubs/questions'
import hints from '../stubs/hints'
import { randomInteger } from '@/ts/helpers'

enum State {
  Confirm,
  Question,
  Success,
  Fail
}

const Help: React.FC = () => {
  const [state, setState] = useState(State.Confirm)
  const [question, setQuestion] = useState(questions[0])
  const [rightAnswer, setRightAnswer] = useState(false)
  const [hint, setHint] = useState(hints[0])
  const { closeAllPopups } = useStore()


  const getQuestion = () => {
    const randomIndex = randomInteger(0, questions.length - 1)
    const randomQuestion = questions.splice(randomIndex, 1)[0]
    setQuestion(randomQuestion)
    setState(State.Question)
  }

  const getHint = () => {
    const randomIndex = randomInteger(0, hints.length - 1)
    const randomHint = hints.splice(randomIndex, 1)[0]
    setHint(randomHint)
  }

  const getResult = (e: React.FormEvent) => {
    e.preventDefault()
    if (rightAnswer) {
      getHint()
      setState(State.Success)
    } else {
      setState(State.Fail)
    }
  }

  const changeAnswer = (value: boolean) => () => {
    setRightAnswer(value)
    console.log(value)
  }

  const renderConfirm = () => {
    return (
      <div className="help__container">
        <h3 className="help__title">УВЕРЕН, ЧТО ЗНАЕШЬ О&nbsp;ФК&nbsp;&laquo;ЗЕНИТ&raquo; ВСЕ?</h3>
        <div className="help__text">
          <p>Тогда легко получишь подсказку</p>
        </div>
        <div className="help__controls">
          <button className="help__btn btn btn--orange" type="button" onClick={getQuestion}>Нужна подсказка</button>
          <button className="help__btn btn btn--blue" type="button" onClick={closeAllPopups}>Нет, спасибо</button>
        </div>
      </div>
    )
  }

  const renderQuestion = () => {
    const { title, answers } = question
    return (
      <form className="help__container" onSubmit={getResult}>
        <h3 className="help__title" dangerouslySetInnerHTML={{ __html: title }} />
        <div className="help__text">
          {answers.map(({ text, success }, i) => (
            <label className="help__radio" key={i}>
              <input type="radio" name="answer" required onChange={changeAnswer(success)} />
              <span />
              {text}
            </label>
          ))}
        </div>
        <div className="help__controls">
          <button className="help__btn btn btn--orange" type="submit">Ответить</button>
        </div>
      </form>
    )
  }

  const renderSuccess = () => {
    return (
      <div className="help__container">
        <h3 className="help__title">Да&nbsp;ты&nbsp;гений. Подсказка твоя.</h3>
        <div className="help__text">
          <p dangerouslySetInnerHTML={{ __html: hint }} />
        </div>
        <div className="help__controls">
          <button className="help__btn btn btn--orange" type="button" onClick={closeAllPopups}>OK!</button>
        </div>
      </div>
    )
  }

  const renderFail = () => {
    return (
      <div className="help__container">
        <h3 className="help__title">Мимо</h3>
        <div className="help__text">
          <p>Придется искать самостоятельно</p>
        </div>
        <div className="help__controls">
          <button className="help__btn btn btn--orange" type="button" onClick={closeAllPopups}>OK!</button>
        </div>
      </div>
    )
  }

  return (
    <div className="help popup">
      <div className="popup__overlay" />

      <div className="help__box">
        {state === State.Confirm && renderConfirm()}
        {state === State.Question && renderQuestion()}
        {state === State.Success && renderSuccess()}
        {state === State.Fail && renderFail()}

        <figure className="help__image">
          <img src="/static/img/help-image.png" alt="" />
        </figure>
      </div>


    </div>
  )
}

export default Help
