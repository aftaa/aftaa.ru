import React, { useContext, useState, useEffect, useRef } from 'react'
import players from './stubs/players'
import { Ctx } from './types'

const Context = React.createContext({} as Ctx)
export const useStore = () => useContext(Context)

export const Provider: React.FC = ({ children }) => {
  const [message, setMessage] = useState(false)
  const [player, setPlayer] = useState(players[0])
  const [help, setHelp] = useState(false)
  const [step, setStep] = useState(1)
  const [time, setTime] = useState(0)
  const interval = useRef<NodeJS.Timeout>()

  useEffect(() => {
    startTimer()
  }, [])

  const stopTimer = () => {
    clearInterval(interval.current as NodeJS.Timeout)
  }
  const startTimer = () => {
    setTime(0)
    interval.current = setInterval(() => {
      setTime(time => {
        if (time === 15) {
          setHelp(true)
          stopTimer()
          return time
        }
        return time + 1
      })
    }, 1000)
  }

  const openCard = () => {
    stopTimer()
    setMessage(true)
  }

  const closeAllPopups = () => {
    setMessage(false)
    setHelp(false)
  }

  const nextStep = () => {
    closeAllPopups()
    if (step === 3 || player.prize) {
      // alert('Что-то дальше...')
      return
    }
    setStep(step => {
      return step + 1
    })
    startTimer()
  }

  const values = { message, openCard, nextStep, player, setPlayer, help, step, time, closeAllPopups }

  return (
    <Context.Provider value={values}>
      {children}
    </Context.Provider>
  )
}
