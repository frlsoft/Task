<?php echo validation_errors();?>
<?php echo form_open('user/saveuser');?>
�û���<input type="input" name="username" value="<?php echo set_value('username')?>"/>
����<input type="input" name="password" value="<?php echo set_value('password')?>"/>
</br>
<input type="submit" name="submit" value="login" />
</form>