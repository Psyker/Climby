import { Box, BoxProps, KleeFontFamily, KleeFontWeight, useColorModeValue } from '@liinkiing/klee'
import Link, { LinkProps } from 'next/link'
import { forwardRef } from 'react'

interface Props extends LinkProps, BoxProps {}

const AppLink = forwardRef<HTMLElement, Props>(
  ({ href, as, replace, scroll, shallow, prefetch, passHref = true, ...rest }, ref) => {
    return (
      <Link
        href={href}
        as={as}
        replace={replace}
        scroll={scroll}
        shallow={shallow}
        passHref={passHref}
        prefetch={prefetch}
      >
        <Box
          ref={ref}
          sx={{ textDecoration: 'none' }}
          fontWeight={KleeFontWeight.Semibold}
          fontFamily={KleeFontFamily.Body}
          color={useColorModeValue('blue.800', 'blue.400')}
          as="a"
          {...rest}
        />
      </Link>
    )
  },
)

AppLink.displayName = 'AppLink'

export default AppLink
