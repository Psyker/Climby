import { Heading, Icon, IconButton, Menu, Modal, Text, useColorMode } from '@liinkiing/klee'
import type { IconButtonProps } from '@liinkiing/klee'
import type { VFC } from 'react'
import { FiSun, FiMoon, FiMoreVertical, FiInfo } from 'react-icons/fi'

export const SchemeToggler: VFC<Omit<IconButtonProps, 'icon'>> = ({ ...props }) => {
  const { mode, toggleMode } = useColorMode()

  return (
    <Menu loop closeOnSelect={false}>
      <Menu.Button as={IconButton} variant="transparent" icon={<Icon as={FiMoreVertical} />} {...props} />
      <Menu.List ariaLabel="options">
        <Menu.ListItem onClick={toggleMode}>
          <Icon as={mode === 'light' ? FiMoon : FiSun} />
          <Text>Toggle {mode === 'light' ? 'dark' : 'light'} theme</Text>
        </Menu.ListItem>
        <Modal
          disclosure={
            <Menu.ListItem>
              <Icon as={FiInfo} />
              <Text>About</Text>
            </Menu.ListItem>
          }
          ariaLabel="about-modal"
        >
          <Modal.Header>
            <Heading>About</Heading>
          </Modal.Header>
          <Modal.Body textAlign={'justify'} gap={8}>
            <Text>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores dignissimos ducimus ea labore quod.
              Ab accusamus, animi architecto autem blanditiis ducimus expedita iure magni nostrum optio quae quibusdam,
              soluta totam?
            </Text>
            <Text>
              Architecto culpa excepturi nisi reiciendis voluptatibus. Assumenda ducimus iste laudantium minima
              quibusdam! Accusantium animi aspernatur, debitis est et eveniet harum, illo ipsum iste odit, quas rem
              sequi unde vitae voluptate.
            </Text>
            <Text>
              Nihil, odio velit. Accusamus accusantium at, consequuntur deserunt dolores et, fugit nam perferendis
              provident quaerat quisquam sequi, suscipit ullam unde voluptates! Cum delectus eaque et illum libero,
              soluta unde. Libero?
            </Text>
            <Text>
              Accusantium beatae deserunt dolorum enim error expedita ipsa labore laudantium magnam, minima
              necessitatibus nemo nihil obcaecati porro quam quidem quo recusandae reiciendis repellat sint sit
              temporibus vel vero vitae voluptatem!
            </Text>
            <Text>
              Architecto corporis cupiditate dolor ipsa ipsum iste iure laboriosam, minus molestias mollitia nisi porro
              provident quo quos ratione sequi temporibus veniam. Ab, alias qui. Consequatur delectus ea iusto modi
              voluptatem!
            </Text>
          </Modal.Body>
          <Modal.Footer />
        </Modal>
      </Menu.List>
    </Menu>
  )
}

export default SchemeToggler
