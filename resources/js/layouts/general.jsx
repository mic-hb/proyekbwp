import NavBar from '@/components/NavBar'
import Footer from '@/components/footer'

export default function GeneralLayout({ children }) {
  return (
    <div className='min-h-screen flex flex-col justify-between'>
      <NavBar />
      <div className='max-w-screen-lg container mx-auto px-4 py-8'>
        {children}
      </div>
      <Footer />
    </div>
  )
}
