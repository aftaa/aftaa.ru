import React from 'react'
import SwiperCore, { Navigation, Pagination } from 'swiper'
import { Swiper, SwiperSlide } from 'swiper/react'
import Card from '../components/Card'
import players from '../stubs/players'

SwiperCore.use([Navigation, Pagination])

const Slider: React.FC = () => {
  const options = {
    slidesPerView: 2,
    loop: true,
    centeredSlides: true,
    navigation: true,
    pagination: {
      el: '.game__pagination',
      clickable: true,
      bulletActiveClass: 'active'
    },
    breakpoints: {
      769: {
        // initialSlide: 4,
        slidesPerView: 6
      }
    }
  }

  return (
    <div className="game__slider">
      <Swiper {...options}>
        {players.map(player => (
          <SwiperSlide key={player.number}>
            <Card player={player} />
          </SwiperSlide>
        ))}
      </Swiper>
      <div className="game__pagination" />
    </div>
  )
}

export default Slider
