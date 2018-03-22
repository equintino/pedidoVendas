<?php
/**
 * Mapper for {@link Todo} from array.
 * @see TodoValidator
 */
final class UserMapper {
    private function __construct() {
    }
    /**
     * Maps array to the given {@link Todo}.
     * <p>
     * Expected properties are:
     * <ul>
     *   <li>id</li>
     *   <li>priority</li>
     *   <li>created_on</li>
     *   <li>due_on</li>
     *   <li>last_modified_on</li>
     *   <li>title</li>
     *   <li>description</li>
     *   <li>comment</li>
     *   <li>status</li>
     *   <li>deleted</li>
     * </ul>
     * @param User $user
     * @param array $properties
     */
    public static function map(User $user, array $properties) {
        if (array_key_exists('id', $properties)){
            $user->setId($properties['id']);
        }
        if (array_key_exists('nome', $properties)){
            $user->setNome($properties['nome']);
        }
        if (array_key_exists('login', $properties)){
            $user->setLogin($properties['login']);
        }
        if (array_key_exists('senha', $properties)){
            $user->setSenha($properties['senha']);
        }
        if (array_key_exists('email', $properties)){
            $user->setEmail($properties['email']);
        }
        if (array_key_exists('loja', $properties)){
            $user->setLoja($properties['loja']);
        }
        if (array_key_exists('funcao', $properties)){
            $user->setFuncao($properties['funcao']);
        }
        if (array_key_exists('OMIE_APP_KEY', $properties)){
            $user->setOMIE_APP_KEY($properties['OMIE_APP_KEY']);
        }
        if (array_key_exists('OMIE_APP_SECRET', $properties)){
            $user->setOMIE_APP_SECRET($properties['OMIE_APP_SECRET']);
        }
    }
}
?>